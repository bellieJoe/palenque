<?php

namespace App\Livewire\Main\Supplier;

use App\Models\Delivery;
use App\Models\Origin;
use App\Models\Supplier;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class SupplierIndex extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $listeners = [
        'refresh-suppliers'
    ];

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function deleteSupplier($id){
        if(Delivery::where('supplier_id', $id)->exists()){
            notyf()->position('y', 'top')->error('Cannot delete supplier with existing deliveries!');
            return;
        }
        Supplier::where('id', $id)->update([
            'restore_date' => now()->addDays(60)->format('Y-m-d')
        ]);
        Supplier::where("id", $id)->delete();
        notyf()->position('y', 'top')->success('Supplier deleted successfully!');
        $this->dispatch('refresh-suppliers');
    }

    public function editSupplier($id)
    {
        $this->dispatch('editSupplier', $id);
    }

    public function deleteOrigin($id)
    {
        // if(Supplier::where('origin_id', $id)->exists()){
        //     notyf()->position('y', 'top')->error('Cannot delete origin with existing suppliers!');
        //     return;
        // }
        Origin::find($id)
        ->update([
            'restore_date' => now()->addDays(60)->format('Y-m-d')
        ]);

        Origin::find($id)->delete();
        notyf()->position('y', 'top')->success('Origin deleted successfully!');
        $this->dispatch('refresh-suppliers');
    }

    public function restoreOrigin($id){
        Origin::withTrashed()->find($id)->update(['restore_date' => null]);
        Origin::withTrashed()->find($id)->restore();
        notyf()->position('y', 'top')->success('Origin restored successfully!');
    }

    public function restoreSupplier($id){
        Supplier::withTrashed()->find($id)->update(['restore_date' => null]);
        Supplier::withTrashed()->find($id)->restore();
        notyf()->position('y', 'top')->success('Supplier restored successfully!');
    }

    public function render()
    {
        $suppliers = Supplier::query()
        ->withTrashed()
        ->with('origin', function($q){
            $q->withTrashed();
        })
        ->where(function ($q) {
            $q->whereNull('deleted_at') // active records (ignore restore_date)
            ->orWhere(function ($q) {
                $q->whereNotNull('deleted_at') // deleted records
                    ->whereDate('restore_date', '>', today());
            });
        })
        ->where('name', 'like', '%' . $this->search . '%')
        ->where('municipal_market_id', auth()->user()->marketDesignation()->id)
        ->orderBy('restore_date', 'asc')
        ->paginate(10);
        $origins = Origin::query()
                ->where('municipal_market_id', auth()->user()->marketDesignation()->id)
                ->where(function ($q) {
                    $q->whereNull('deleted_at') // active records (ignore restore_date)
                    ->orWhere(function ($q) {
                        $q->whereNotNull('deleted_at') // deleted records
                            ->whereDate('restore_date', '>', today());
                    });
                })
                ->withTrashed()
                ->orderBy('restore_date', 'asc')
                ->get();

        return view('livewire.main.supplier.supplier-index', [
            'suppliers' => $suppliers,
            'origins' => $origins
        ]);
    }
}

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
        Origin::find($id)->delete();
        notyf()->position('y', 'top')->success('Origin deleted successfully!');
        $this->dispatch('refresh-suppliers');
    }

    public function render()
    {
        $suppliers = Supplier::query()->where('name', 'like', '%' . $this->search . '%')->where('municipal_market_id', auth()->user()->marketDesignation()->id)->paginate(10);
        $origins = Origin::where("municipal_market_id", auth()->user()->marketDesignation()->id)->get();
        return view('livewire.main.supplier.supplier-index', [
            'suppliers' => $suppliers,
            'origins' => $origins
        ]);
    }
}

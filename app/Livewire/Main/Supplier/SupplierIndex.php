<?php

namespace App\Livewire\Main\Supplier;

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
        Supplier::where($id)->delete();
        notyf()->position('y', 'top')->success('Supplier deleted successfully!');
        $this->dispatch('refresh-suppliers');
    }

    public function editSupplier($id)
    {
        $this->dispatch('editSupplier', $id);
    }

    public function render()
    {
        $suppliers = Supplier::query()->where('name', 'like', '%' . $this->search . '%')->where('municipal_market_id', auth()->user()->marketDesignation()->id)->paginate(10);
        return view('livewire.main.supplier.supplier-index', [
            'suppliers' => $suppliers
        ]);
    }
}

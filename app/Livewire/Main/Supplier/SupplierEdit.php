<?php

namespace App\Livewire\Main\Supplier;

use App\Models\Origin;
use App\Models\Supplier;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SupplierEdit extends Component
{
    protected $listeners = [
        "editSupplier" => "editSupplier"
    ];
    public $supplier;
    #[Validate('required|max:255')]
    public $name = "";
    #[Validate('nullable|exists:origins,id')]
    public $address = "";
    #[Validate('nullable|max:20')]
    public $contact_number = "";
    #[Validate('nullable|max:5000')]
    public $description = "";
    #[Validate('required|email|max:60')]
    public $email = "";
    public $origins;

    public function editSupplier($id){
        $supplier = Supplier::find($id);
        $this->supplier = $supplier;
        $this->name = $supplier->name;
        $this->address = $supplier->address;
        $this->contact_number = $supplier->contact_number;
        $this->description = $supplier->description;
        $this->email = $supplier->email;
        $this->dispatch('show-edit-supplier-modal');
    }

    public function updateSupplier(){
        $this->validate();
        $supplier = Supplier::find($this->supplier->id);
        Gate::authorize('update', $supplier);
        $supplier->name = $this->name;
        $supplier->address = $this->address;
        $supplier->origin_id = $this->address;
        $supplier->contact_number = $this->contact_number;
        $supplier->description = $this->description;
        $supplier->email = $this->email;
        $supplier->save();
        notyf()->position('y', 'top')->success('Supplier updated successfully!');
        $this->dispatch('hide-edit-supplier-modal');
        $this->dispatch('refresh-suppliers');
        $this->resetErrorBag();
    }

    public function mount(){
        $this->origins = Origin::where("municipal_market_id", auth()->user()->marketDesignation()->id)->get();
    }
    
    public function render()
    {
        return view('livewire.main.supplier.supplier-edit');
    }
}

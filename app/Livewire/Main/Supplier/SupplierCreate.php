<?php

namespace App\Livewire\Main\Supplier;

use App\Models\Supplier;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SupplierCreate extends Component
{
    #[Validate('required|max:255')]
    public $name = "";
    #[Validate('nullable|max:100')]
    public $address = "";
    #[Validate('nullable|max:20')]
    public $contact_number = "";
    #[Validate('nullable|max:5000')]
    public $description = "";
    #[Validate('required|email|max:60')]
    public $email = "";

    public function saveSupplier(){
        $this->validate();
        Supplier::create([
            "name" => $this->name,
            "email" => $this->email,
            "address" => $this->address,
            "contact_number" => $this->contact_number,
            "description" => $this->description,
            "municipal_market_id" => auth()->user()->marketDesignation()->id
        ]);
        notyf()->position('y', 'top')->success('Supplier created successfully!');
        $this->dispatch('hide-create-supplier-modal');
        $this->dispatch('refresh-suppliers');
        return;
    }

    public function showCreateSupplierModal(){
        $this->reset(['name', 'email', 'address', 'contact_number', 'description']);
        $this->resetErrorBag();
        $this->dispatch('show-create-supplier-modal');
    }

    public function render()
    {
        return view('livewire.main.supplier.supplier-create');
    }
}

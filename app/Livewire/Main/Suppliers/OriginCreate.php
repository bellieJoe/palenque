<?php

namespace App\Livewire\Main\Suppliers;

use App\Models\Origin;
use Livewire\Attributes\Validate;
use Livewire\Component;

class OriginCreate extends Component
{
    #[Validate("required")]
    public $address;
    #[Validate("required")]
    public $is_local;

    public function storeOrigin(){
        $this->validate();
        Origin::create([
            "name" => $this->address,
            "is_local" => $this->is_local,
            "municipal_market_id" => auth()->user()->marketDesignation()->id
        ]);
        notyf()->position('y', 'top')->success('Origin created successfully!');
        return $this->redirectRoute('main.suppliers.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.main.suppliers.origin-create');
    }
}

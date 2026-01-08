<?php

namespace App\Livewire\Main\Suppliers;

use App\Models\Origin;
use Livewire\Attributes\Validate;
use Livewire\Component;

class OriginEdit extends Component
{
    #[Validate("required")]
    public $address;
    #[Validate("required")]
    public $is_local;
    public $origin_id;

    public function mount($id) {
        $origin = Origin::find($id);
        $this->address = $origin->name;
        $this->is_local = $origin->is_local ? true : false;
        $this->origin_id = $id;
    }

    public function saveOrigin(){
        $this->validate();
        $origin = Origin::find($this->origin_id);
        $origin->name = $this->address;
        $origin->is_local = $this->is_local;
        $origin->save();
        notyf()->position('y', 'top')->success('Origin updated successfully!');
        return $this->redirectRoute('main.suppliers.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.main.suppliers.origin-edit');
    }
}

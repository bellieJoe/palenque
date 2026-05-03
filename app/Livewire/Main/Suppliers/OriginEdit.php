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
    public $origin;

    public function mount($id) {
        $origin = Origin::find($id);
        $this->address = $origin->name;
        $this->is_local = $origin->is_local ? true : false;
        $this->origin_id = $id;
        $this->origin = $origin;
    }

    public function saveOrigin(){
        $this->validate();
        $origin = Origin::find($this->origin_id);
        $origin->name = $this->address;
        $origin->is_local = $this->is_local;
        $origin->save();
        notyf()->position('y', 'top')->success('Origin updated successfully!');
        
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
        return $this->redirectRoute('main.suppliers.index', navigate: true);
        $this->dispatch('refresh-suppliers');
    }

    public function render()
    {
        return view('livewire.main.suppliers.origin-edit');
    }
}

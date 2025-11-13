<?php

namespace App\Livewire\Main\Goods;

use App\Models\Unit;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UnitEdit extends Component
{
    public $unit;
    #[Validate('required')]
    public $name;
    
    public function mount($id)
    {
        $this->unit = Unit::find($id);
        $this->name =  $this->unit->name;
    }

    public function updateUnit()
    {
        $this->validate();
        Unit::where("id", $this->unit->id)->update([
            'name' => $this->name
        ]);
        notyf()->position('y', 'top')->success('Unit updated successfully!');
        return $this->redirectRoute('main.units.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.main.goods.unit-edit');
    }
}

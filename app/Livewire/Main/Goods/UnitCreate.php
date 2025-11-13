<?php

namespace App\Livewire\Main\Goods;

use App\Models\Unit;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UnitCreate extends Component
{
    #[Validate('required')]
    public $name;

    public function storeUnit()
    {
        $this->validate();
        Unit::create([
            'name' => $this->name,
            'municipal_market_id' => auth()->user()->marketDesignation()->id
        ]);
        notyf()->position('y', 'top')->success('Unit created successfully!');
        return $this->redirectRoute('main.units.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.main.goods.unit-create');
    }
}

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
    #[Validate('required|boolean')]
    public $is_base_unit;
    #[Validate('nullable|required_if:is_base_unit,false')]
    public $base_unit;
    #[Validate('nullable|required_if:is_base_unit,false')]
    public $conversion_factor;
    public $base_units;
    
    public function mount($id)
    {
        $this->unit = Unit::find($id);
        $this->name =  $this->unit->name;
        $this->is_base_unit =  $this->unit->is_base_unit ? true : false;
        $this->base_unit =  $this->unit->base_unit_id;
        $this->conversion_factor =  $this->unit->conversion_factor;
        $this->base_units = Unit::where('is_base_unit', true)->where('municipal_market_id', auth()->user()->marketDesignation()->id)->whereNot("id", $this->unit->id)->get();
    }

    public function updateUnit()
    {
        $this->validate();
        Unit::where("id", $this->unit->id)->update([
            'name' => $this->name,
            'is_base_unit' => $this->is_base_unit,
            'base_unit_id' => $this->is_base_unit ? null : $this->base_unit,
            'conversion_factor' => $this->is_base_unit ? 1 : $this->conversion_factor
        ]);
        notyf()->position('y', 'top')->success('Unit updated successfully!');
        return $this->redirectRoute('main.units.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.main.goods.unit-edit');
    }
}

<?php

namespace App\Livewire\Main\Stall;

use App\Models\Building;
use Livewire\Attributes\Validate;
use Livewire\Component;

use function Flasher\Notyf\Prime\notyf;

class BuildingEdit extends Component
{
    public $building;
    #[Validate('required')]
    public $name;

    public function mount($id)
    {
        $this->building = Building::find($id);
        $this->name = $this->building->name;
    }

    public function save()
    {
        $this->validate();
        if(Building::whereNot("id", $this->building->id)->where("name", $this->name)->where("municipal_market_id", auth()->user()->marketDesignation()->id)->exists()){
            return notyf()->position('y', 'top')->error('Building already exists.');
        }
        $this->building->name = $this->name;
        $this->building->save();
        notyf()->position('y', 'top')->success('Building updated successfully!');
    }

    public function render()
    {
        return view('livewire.main.stall.building-edit');
    }
}

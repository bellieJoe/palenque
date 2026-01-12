<?php

namespace App\Livewire\Main\Stalls;

use App\Models\Building;
use Livewire\Attributes\Validate;
use Livewire\Component;
use SebastianBergmann\CodeCoverage\Node\Builder;

use function Flasher\Notyf\Prime\notyf;

class BuildingCreate extends Component
{
    #[Validate("required")]
    public $name;

    public function save(){
        $this->validate();
        if(Building::where("name", $this->name)->where("municipal_market_id", auth()->user()->marketDesignation()->id)->exists()){
            return notyf()->position('y', 'top')->error('Building already exists.');
        }
        Building::create([
            "name" => $this->name,
            "municipal_market_id" => auth()->user()->marketDesignation()->id,
        ]);
        notyf()->position('y', 'top')->success('Building created successfully!');
        $this->redirect(route('main.buildings.index'));
    }
    public function render()
    {
        return view('livewire.main.stalls.building-create');
    }
}

<?php

namespace App\Livewire\Main\Stall;

use App\Models\Building;
use App\Models\Stall;
use App\Models\StallRate;
use Livewire\Attributes\Validate;
use Livewire\Component;

class StallCreate extends Component
{
    public $buildings;
    public $stallRates;
    #[Validate('required|max:255')]
    public $name;
    #[Validate('required')]
    public $stall_rate;
    #[Validate('required')]
    public $area;
    #[Validate('required|max:255|min:3')]
    public $location;
    #[Validate('required|in:WET,DRY')]
    public $productType;
    #[Validate('required|exists:buildings,id')]
    public $building;

    public function showCreateStallModal()
    {
        $this->dispatch('show-create-stall-modal');
    }

    public function saveStall()
    {
        $this->validate();
        Stall::create([
            "name" => $this->name,
            "municipal_market_id" => auth()->user()->marketDesignation()->id,
            "stall_rate_id" => $this->stall_rate,
            "area" => $this->area,
            "location" => $this->location,
            "product_type" => $this->productType,
            "building_id" => $this->building
        ]);
        $this->reset(['name', 'stall_rate', 'area', 'location', 'productType']);
        notyf()->position('y', 'top')->success('Stall created successfully!');
        $this->dispatch('hide-create-stall-modal');
        $this->dispatch('refresh-stalls');
        return;
    }

    public function render()
    {
        return view('livewire.main.stall.stall-create');
    }

    public function mount(){
        $this->buildings = Building::where("municipal_market_id", auth()->user()->marketDesignation()->id)->get();
        $this->stallRates = StallRate::all();
    }
}

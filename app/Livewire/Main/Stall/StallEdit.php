<?php

namespace App\Livewire\Main\Stall;

use App\Models\Building;
use App\Models\Stall;
use App\Models\StallRate;
use Livewire\Attributes\Validate;
use Livewire\Component;

class StallEdit extends Component
{
    protected $listeners = [
        'editStall' => 'editStall'
    ];
    public $buildings;
    public $stallRates;
    public $stall;
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

    public function editStall($id)
    {
        $stall = Stall::find($id);
        $this->stall = $stall;
        $this->name = $stall->name;
        $this->area = $stall->area;
        $this->stall_rate = $stall->stall_rate_id;
        $this->location = $stall->location;
        $this->productType = $stall->product_type;
        $this->building = $stall->building_id;
        $this->dispatch('show-edit-stall-modal');
    }
    
    public function updateStall()
    {
        $this->validate();
        $this->stall->name = $this->name;
        $this->stall->stall_rate_id = $this->stall_rate;
        $this->stall->area = $this->area;
        $this->stall->product_type = $this->productType;
        $this->stall->location = $this->location;
        $this->stall->building_id = $this->building;
        $this->stall->save();
        notyf()->position('y', 'top')->success('Stall updated successfully!');
        $this->dispatch('hide-edit-stall-modal');
        $this->dispatch('refresh-stalls');
        $this->reset(['name', 'stall_rate', 'area']);
    }
    
    public function render()
    {
        return view('livewire.main.stall.stall-edit');
    }

    public function mount()
    {
        $this->buildings = Building::where("municipal_market_id", auth()->user()->marketDesignation()->id)->get();
        $this->stallRates = StallRate::all();
    }
}

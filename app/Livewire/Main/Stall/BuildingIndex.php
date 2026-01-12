<?php

namespace App\Livewire\Main\Stall;

use App\Models\Building;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class BuildingIndex extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $buildings = Building::where("municipal_market_id", auth()->user()->marketDesignation()->id)->with("stalls")->paginate(20);
        return view('livewire.main.stall.building-index',
        [
            "buildings" => $buildings
        ]);
    }
}

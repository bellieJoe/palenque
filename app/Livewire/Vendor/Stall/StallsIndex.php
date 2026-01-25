<?php

namespace App\Livewire\Vendor\Stall;

use App\Models\StallOccupant;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class StallsIndex extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $search;
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $stallOccupants = StallOccupant::where('vendor_id', auth()->user()->vendor->id)
        ->with("stall", function($query){
            $query->withTrashed();
            $query->where("name", "like", "%{$this->search}%");
        })
        ->whereHas("stallContract", function($query) {
            $query->where("status", "ACTIVE");
            $query->where("to", ">=", now());
        })
        ->get();
        return view('livewire.vendor.stall.stalls-index', [
            'stallOccupants' => $stallOccupants
        ]);
    }
}

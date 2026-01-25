<?php

namespace App\Livewire\Vendor\Violations;

use App\Models\StallOccupant;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ViolationIndex extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $listeners = [
        "refresh-violations"
    ];
    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        $stallOccupants = StallOccupant::whereHas("vendor", function($query) {
            $query->where("municipal_market_id", auth()->user()->marketDesignation()->id);
            $query->where("vendor_id", auth()->user()->vendor->id);
        })
        ->with("stall", function($query) {
            $query->withTrashed();
            $query->where("name", "like", "%{$this->search}%");
        })
        ->orderBy("vendor_id", "asc")
        ->paginate(10);
        return view('livewire.vendor.violations.violation-index', [
            "stallOccupants" => $stallOccupants
        ]);
    }
}

<?php

namespace App\Livewire\Main\Violation;

use App\Models\Stall;
use App\Models\Vendor;
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
        $vendors = Vendor::query()->where("name", "like", "%{$this->search}%")
            ->where("municipal_market_id", auth()->user()->marketDesignation()->id)
            // ->with([])
            ->paginate(10);
        return view('livewire.main.violation.violation-index', [
            'vendors' => $vendors
        ]);
    }
}

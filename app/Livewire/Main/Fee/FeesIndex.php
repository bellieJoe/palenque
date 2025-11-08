<?php

namespace App\Livewire\Main\Fee;

use App\Models\Fee;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class FeesIndex extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $listeners = [
        "refresh-fees"
    ];
    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $marketId = auth()->user()->marketDesignation()->id;
        $fees = Fee::query()
            ->where("municipal_market_id", $marketId)
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->whereHas("stallOccupant.vendor", fn($v) =>
                        $v->where("name", "like", "%{$this->search}%")
                    )
                    ->orWhereHas("supplier", fn($s) =>
                        $s->where("name", "like", "%{$this->search}%")
                    );
                });
            })
            ->paginate(20);
        return view('livewire.main.fee.fees-index', [
            'fees' => $fees
        ]);
    }
}

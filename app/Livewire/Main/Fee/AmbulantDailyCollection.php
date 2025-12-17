<?php

namespace App\Livewire\Main\Fee;

use App\Models\AmbulantStall;
use App\Models\Fee;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class AmbulantDailyCollection extends Component
{
    use WithoutUrlPagination, WithPagination;
    public $dateFilter;

    public function updateDateFilter($value)
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->dateFilter = now()->format('Y-m-d');
    }

    public function render()
    {
        $ambulantStalls = AmbulantStall::where("municipal_market_id", auth()->user()->marketDesignation()->id)
            ->orderBy('name', 'ASC')
            ->get();
        $collectedFees = Fee::whereDate('date_issued', $this->dateFilter ?? now())
            ->where('municipal_market_id', auth()->user()->marketDesignation()->id)
            ->where('fee_type', 'STALL')
            ->get();
        return view('livewire.main.fee.ambulant-daily-collection', [
            'ambulantStalls' => $ambulantStalls,
            'collectedFees' => $collectedFees
        ]);
    }
}

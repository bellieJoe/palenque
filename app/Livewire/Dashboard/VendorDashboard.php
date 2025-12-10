<?php

namespace App\Livewire\Dashboard;

use App\Models\AmbulantStall;
use App\Models\Fee;
use App\Models\Stall;
use App\Models\Violation;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class VendorDashboard extends Component
{
    use WithoutUrlPagination, WithPagination;
    public $startFilter;
    public $endFilter;

    public $stallsCount = 0;
    public $ambulantStallsCount = 0;
    public $violationsCount = 0;

    public $dailyFeesCollectionCategories = [];
    public $dailyCollectionData = [];

    public function updatingStartFilter()
    {
        $this->resetPage();
    }

    public function updatingEndFilter()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->startFilter = Carbon::parse(date('Y')."-01-01")->format('Y-m-d');
        $this->endFilter = Carbon::parse(date('Y')."-12-31")->format('Y-m-d'); 
    }

    public function getDailyCollectionData()
    {
        $this->dailyFeesCollectionCategories = $this->getMonthsArray($this->startFilter, $this->endFilter);
        $this->dailyCollectionData = collect($this->marketFeesCollectionCategories)->map(function($monthYear) {
            return round(Fee::where("municipal_market_id", auth()->user()->marketDesignation()->id)
            ->where("status", "PAID")
            ->where("fee_type", "STALL")
            ->where("owner_id", auth()->user()->vendor->id)
            ->whereMonth("date_paid", Carbon::parse($monthYear)->format('m'))
            ->whereYear("date_paid", Carbon::parse($monthYear)->format('Y'))
            ->pluck("amount")
            ->sum(), 2);
        });
        $this->dispatch('updateMarketFeesChart', [
            'categories' => $this->dailyFeesCollectionCategories,
            'dailyCollectionData' => $this->ambulantStallCollectionData,
        ]);
    }

    private function getMonthsArray($start, $end)
    {
        if(!$start || !$end) {
            notyf()->position('y', 'top')->error('Please provide both start and end date for the filter.');
            return [];
        }
        if(Carbon::parse($start)->gt(Carbon::parse($end))) {
            notyf()->position('y', 'top')->error('Start date must be before end date.');
            return [];
        }
        $months = [];
        $startDate = Carbon::parse($start)->startOfMonth();
        $endDate = Carbon::parse($end)->startOfMonth();
        while($startDate->lte($endDate)) {
            $months[] = $startDate->format('M Y');
            $startDate->addMonth();
        }
        return $months;
    }

    private function init()
    {
        $this->ambulantStallsCount = AmbulantStall::where("vendor_id", auth()->user()->vendor->id)
            ->where("status", 1)
            ->whereBetween('created_at', [$this->startFilter, Carbon::parse($this->endFilter)->endOfDay()])
            ->count();

        $this->stallsCount = Stall::whereHas('stallOccupants', function ($query) {
            $query->where('vendor_id', auth()->user()->vendor->id);
            $query->where('status', 1);
        })
        ->whereBetween('created_at', [$this->startFilter, Carbon::parse($this->endFilter)->endOfDay()])
        ->count();

        $this->violationsCount = Violation::where('vendor_id', auth()->user()->vendor->id)
            ->whereBetween('created_at', [$this->startFilter, Carbon::parse($this->endFilter)->endOfDay()])
            ->count();

    }
    
    public function render()
    {
        $this->init();  
        return view('livewire.dashboard.vendor-dashboard');
    }
}

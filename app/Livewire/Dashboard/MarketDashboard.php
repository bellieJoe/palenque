<?php

namespace App\Livewire\Dashboard;

use App\Models\AmbulantStall;
use App\Models\Stall;
use App\Models\Supplier;
use App\Models\Vendor;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class MarketDashboard extends Component
{

    use WithoutUrlPagination, WithPagination;
    public $startFilter;
    public $endFilter;

    public $vendorCount = 0;
    public $stallCount = 0;
    public $ambulantStallCount = 0;
    public $supplierCount = 0;

    public $mostViolatedVendorData = [];
    public $topSuppliersData = [];
    
    public function updatingStartFilter()
    {
        $this->resetPage();
    }

    public function updatingEndFilter()
    {
        $this->resetPage();
    }

    private function init()
    {
        $this->vendorCount = Vendor::where("municipal_market_id", auth()->user()->marketDesignation()->id)->count();
        $this->stallCount = Stall::where("municipal_market_id", auth()->user()->marketDesignation()->id)->count();
        $this->ambulantStallCount = AmbulantStall::where("municipal_market_id", auth()->user()->marketDesignation()->id)->count();
        $this->supplierCount = Supplier::where("municipal_market_id", auth()->user()->marketDesignation()->id)->count();
        $this->getMostViolatedVendorData();
        $this->getTopSuppliersData();
    }

    private function getTopSuppliersData()
    {
        $this->topSuppliersData = Supplier::where("municipal_market_id", auth()->user()->marketDesignation()->id)
        ->withCount('deliveries')
        ->orderBy("deliveries_count", "desc")
        ->limit(5)
        ->get()
        ->map(function($supplier) {
            return [
                "x" => $supplier->name,
                "y" => $supplier->deliveries_count
            ];
        });
        $this->dispatch('updateTopSuppliersChart', [
            'data' => $this->topSuppliersData
        ]);
    }

    private function getMostViolatedVendorData()
    {
        $this->mostViolatedVendorData = Vendor::where("municipal_market_id", auth()->user()->marketDesignation()->id)
        ->whereHas("violations", function ($query) {
            $query->whereBetween("created_at", [$this->startFilter, $this->endFilter]);
        })
        ->withCount('violations')
        ->orderBy("violations_count", "desc")
        ->limit(5)
        ->get()
        ->map(function($vendor) {
            return [
                "x" => $vendor->name,
                "y" => $vendor->violations_count
            ];
        });
        Log::info($this->mostViolatedVendorData);
        $this->dispatch('updateMostViolatedVendorChart', [
            'data' => $this->mostViolatedVendorData
        ]);
    }

    public function mount()
    {
        $this->startFilter = Carbon::parse(date('Y')."-01-01")->format('Y-m-d');
        $this->endFilter = Carbon::parse(date('Y')."-12-31")->format('Y-m-d'); 
    }

    public function render()
    {
        $this->init();
        return view('livewire.dashboard.market-dashboard');
    }
}

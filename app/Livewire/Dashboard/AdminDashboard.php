<?php

namespace App\Livewire\Dashboard;

use App\Models\AmbulantStall;
use App\Models\MunicipalMarket;
use App\Models\Role;
use App\Models\RoleType;
use App\Models\Stall;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

use function Flasher\Notyf\Prime\notyf;

class AdminDashboard extends Component
{
    use WithoutUrlPagination, WithPagination;
    public $startFilter;
    public $endFilter;
    
    public $userCount;
    public $supplierCount;
    public $vendorCount;
    public $marketCount;
    // public 

    public $userTrendData = [];
    public $userTrendCategories = [];

    public $userDistributionData = [];
    public $userDistributionCategories = [];

    public $publicMarketUsersData = [];
    public $publicMarketStallsData = [];

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

    private function getUserTrendData($userTrendCategories)
    {
        return collect($userTrendCategories)->map(function($monthYear) {
            $date = Carbon::createFromFormat('M Y', $monthYear);
            return User::whereYear('created_at', $date->year)
                        ->whereMonth('created_at', $date->month)
                        ->count();
        })->toArray();
    }

    private function init()
    {
        $this->supplierCount = Supplier::query()->count();
        $this->vendorCount = Vendor::query()->count();
        $this->marketCount = MunicipalMarket::query()->count();
        $this->userCount = User::query()->count(); 
        $this->userTrendCategories = $this->getMonthsArray($this->startFilter, $this->endFilter);
        $this->userTrendData = $this->getUserTrendData($this->userTrendCategories);
        $this->dispatch('updateUserTrendChart', [
            'categories' => $this->userTrendCategories,
            'data' => $this->userTrendData,
        ]);

        RoleType::query()->get()->each(function($roleType) {
            $this->userDistributionCategories[] = $roleType->name;
            $this->userDistributionData[] = User::whereHas('roles', function ($query) use ($roleType) {
                $query->where('role_type_id', $roleType->id);
            })->count();
        });
        $this->dispatch('updateUserDistributionChart', [
            'categories' => $this->userDistributionCategories,
            'data' => $this->userDistributionData,
        ]);

        $this->publicMarketUsersData = MunicipalMarket::query()->get()->map(function($market) {
            return (object)[
                "x" => $market->name,
                "y" => collect([
                        Vendor::where("municipal_market_id", $market->id)->count(),
                        Role::where("municipal_market_id", $market->id)->count()
                    ])->sum()
                ];
        });
        $this->dispatch('updatePublicMarketUserChart', [
            'data' => $this->publicMarketUsersData,
        ]);

        $this->publicMarketStallsData = MunicipalMarket::query()->get()->map(function($market) {
            return (object)[
                "x" => $market->name,
                "y" => Stall::where("municipal_market_id", $market->id)->count()
            ];
        });
        $this->dispatch('updatePublicMarketStallChart', [
            'data' => $this->publicMarketStallsData,
        ]);
    }

    public function render()
    {
        $this->init();
        return view('livewire.dashboard.admin-dashboard');
    }
}

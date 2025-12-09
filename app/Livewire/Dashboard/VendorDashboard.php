<?php

namespace App\Livewire\Dashboard;

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
    
    public function render()
    {
        return view('livewire.dashboard.vendor-dashboard');
    }
}

<?php

namespace App\Livewire\Main\Reports;

use App\Models\Vendor;
use Livewire\Component;

class VendorsList extends Component
{
    public function render()
    {
        $vendors = Vendor::where("municipal_market_id", auth()->user()->marketDesignation()->id)->get();
        return view('livewire.main.reports.vendors-list', [
            "vendors" => $vendors
        ]);
    }
}

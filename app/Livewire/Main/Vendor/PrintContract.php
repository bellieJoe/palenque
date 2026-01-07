<?php

namespace App\Livewire\Main\Vendor;

use App\Models\ContractSetting;
use App\Models\StallContract;
use Livewire\Component;

class PrintContract extends Component
{
    public $contractSettings;
    public $contract;

    public function mount($id)
    {
        $this->contractSettings = ContractSetting::where("municipal_market_id", auth()->user()->marketDesignation()->id)->first();
        $this->contract = StallContract::find($id);
    }

    public function render()
    {
        return view('livewire.main.vendor.print-contract');
    }
}

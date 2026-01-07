<?php

namespace App\Livewire\Main\Settings;

use App\Models\ContractSetting;
use Livewire\Component;

class ContractSettings extends Component
{
    
    public $municipality_name;
    public $mayor_name;
    public $municipal_address;
    public $market_address;

    public function mount()
    {
        $contract_settings = ContractSetting::where('municipal_market_id', auth()->user()->marketDesignation()->id)->first();

        if ($contract_settings) {
            $this->municipality_name = $contract_settings->municipality_name;
            $this->mayor_name = $contract_settings->mayors_name;
            $this->municipal_address = $contract_settings->address;
            $this->market_address = $contract_settings->market_address;
        }
    }

    public function updateContractSettings()
    {
        $this->validate([
            'municipality_name' => 'required|string|max:255',
            'mayor_name' => 'required|string|max:255',
            'municipal_address' => 'required|string|max:500',
            'market_address' => 'required|string|max:500',
        ]);

        ContractSetting::updateOrCreate(
            ['municipal_market_id' => auth()->user()->marketDesignation()->id],
            [
                'municipality_name' => $this->municipality_name,
                'mayors_name' => $this->mayor_name,
                'address' => $this->municipal_address,
                'market_address' => $this->market_address,
            ]
        );

        notyf()->position('y', 'top')->success('Contract Settings updated successfully!');
    }

    public function render()
    {
        return view('livewire.main.settings.contract-settings');
    }
}

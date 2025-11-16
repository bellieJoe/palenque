<?php

namespace App\Livewire\Main\Settings;

use App\Models\AppSettings;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AppSettingsIndex extends Component
{
    public $app_settings;
    public $enable_online_payment;
    public $paymongo_secret_key;
    public $rent_surcharge_rate;
    public $rent_surcharge_frequency;
    public $rent_grace_period;


    public function updatedEnableOnlinePayment($value)
    {
        // Livewire sends true/false, convert to 1/0
        $this->enable_online_payment = $value ? 1 : 0;
    }

    public function updateOnlinePayment()
    {
        $this->validate([
            'paymongo_secret_key' => 'required_if:enable_online_payment,1'
        ]);

        $this->app_settings->update([
            'enable_online_payment' => $this->enable_online_payment,
            'paymongo_secret_key' => $this->enable_online_payment ? $this->paymongo_secret_key : null, // null if not enabled$this->paymongo_secret_key
        ]);
        notyf()->position('y', 'top')->success('Application Settings updated successfully!');
    }

    public function updateMonthlyRentSettings()
    {
        $this->validate([
            'rent_surcharge_rate' => 'required|numeric|min:0',
            'rent_surcharge_frequency' => 'required|numeric|min:0',
            'rent_grace_period' => 'required|numeric|min:0',
        ]);

        $this->app_settings->update([
            'rent_surcharge_rate' => $this->rent_surcharge_rate,
            'rent_surcharge_frequency' => $this->rent_surcharge_frequency,
            'rent_grace_period' => $this->rent_grace_period,
        ]);
        notyf()->position('y', 'top')->success('Application Settings updated successfully!');
    }


    public function mount()
    {
        $this->app_settings = AppSettings::where('municipal_market_id', auth()->user()->marketDesignation()->id)->first();
        $this->enable_online_payment = $this->app_settings->enable_online_payment;
        $this->paymongo_secret_key = $this->app_settings->paymongo_secret_key;
        $this->rent_surcharge_rate = $this->app_settings->rent_surcharge_rate;
        $this->rent_surcharge_frequency = $this->app_settings->rent_surcharge_frequency;
        $this->rent_grace_period = $this->app_settings->rent_grace_period;
    }

    public function render()
    {
        return view('livewire.main.settings.app-settings-index');
    }
}

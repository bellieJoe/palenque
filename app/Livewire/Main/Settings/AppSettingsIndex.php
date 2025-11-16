<?php

namespace App\Livewire\Main\Settings;

use App\Models\AppSettings;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AppSettingsIndex extends Component
{
    public $app_settings;
    public $enable_online_payment;
    #[Validate('required_if:enable_online_payment,1')]
    public $paymongo_secret_key;

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


    public function mount()
    {
        $this->app_settings = AppSettings::where('municipal_market_id', auth()->user()->marketDesignation()->id)->first();
        $this->enable_online_payment = $this->app_settings->enable_online_payment;
        $this->paymongo_secret_key = $this->app_settings->paymongo_secret_key;
    }

    public function render()
    {
        return view('livewire.main.settings.app-settings-index');
    }
}

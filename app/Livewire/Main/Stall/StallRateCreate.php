<?php

namespace App\Livewire\Main\Stall;

use App\Models\StallRate;
use Livewire\Attributes\Validate;
use Livewire\Component;

class StallRateCreate extends Component
{
    #[Validate('required', 'string', 'max:20')]
    public $name;
    // #[Validate('required', 'code', 'max:10')]
    // public $code;
    #[Validate('required')]
    public $rate;

    public function showCreateStallRateModal()
    {
        $this->dispatch('show-create-stall-rate-modal');
    }

    public function saveStall()
    {
        $this->validate();
        StallRate::create([
            "name" => $this->name,
            // "code" => $this->code,
            "rate" => $this->rate,
            "municipal_market_id" => auth()->user()->marketDesignation()->id
        ]);
        notyf()->position('y', 'top')->success('Stall Rate created successfully!');
        $this->reset(['name', 'rate']);
        $this->dispatch('hide-create-stall-rate-modal');
        $this->dispatch('refresh-stall-rates');
        return;
    }

    public function render()
    {
        return view('livewire.main.stall.stall-rate-create');
    }
}

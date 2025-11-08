<?php

namespace App\Livewire\Main\Stall;

use App\Models\Stall;
use App\Models\StallRate;
use Livewire\Attributes\Validate;
use Livewire\Component;

class StallCreate extends Component
{
    public $stallRates;
    #[Validate('required|max:255')]
    public $name;
    #[Validate('required')]
    public $stall_rate;
    #[Validate('required')]
    public $area;

    public function showCreateStallModal()
    {
        $this->dispatch('show-create-stall-modal');
    }

    public function saveStall()
    {
        $this->validate();
        Stall::create([
            "name" => $this->name,
            "municipal_market_id" => auth()->user()->marketDesignation()->id,
            "stall_rate_id" => $this->stall_rate,
            "area" => $this->area
        ]);
        notyf()->position('y', 'top')->success('Stall created successfully!');
        $this->dispatch('hide-create-stall-modal');
        $this->dispatch('refresh-stalls');
        return;
    }

    public function render()
    {
        return view('livewire.main.stall.stall-create');
    }

    public function mount(){
        $this->stallRates = StallRate::all();
    }
}

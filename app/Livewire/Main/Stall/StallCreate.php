<?php

namespace App\Livewire\Main\Stall;

use App\Models\Stall;
use Livewire\Attributes\Validate;
use Livewire\Component;

class StallCreate extends Component
{
    #[Validate('required|max:255')]
    public $name;

    public function showCreateStallModal()
    {
        $this->dispatch('show-create-stall-modal');
    }

    public function saveStall()
    {
        $this->validate();
        Stall::create([
            "name" => $this->name,
            "municipal_market_id" => auth()->user()->marketDesignation()->id
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
}

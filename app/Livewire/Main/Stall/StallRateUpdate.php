<?php

namespace App\Livewire\Main\Stall;

use App\Models\StallRate;
use Livewire\Attributes\Validate;
use Livewire\Component;

class StallRateUpdate extends Component
{

    protected $listeners = [
        'editStallRate' => 'editStallRate'
    ];

    public $stallRate;
   #[Validate('required', 'string', 'max:20')]
    public $name;
    // #[Validate('required', 'code', 'max:10')]
    // public $code;
    #[Validate('required')]
    public $rate;

    public function editStallRate($id)
    {
        $stallRate = StallRate::find($id);
        $this->stallRate = $stallRate;
        $this->name = $stallRate->name;
        // $this->code = $stallRate->code;
        $this->rate = $stallRate->rate;
        $this->dispatch('show-edit-stall-rate-modal');
    }
    
    public function updateStallRate()
    {
        $this->validate();
        $this->stallRate->name = $this->name;
        // $this->stallRate->code = $this->code;
        $this->stallRate->rate = $this->rate;
        $this->stallRate->save();
        notyf()->position('y', 'top')->success('Stall Rate updated successfully!');
        $this->dispatch('hide-edit-stall-rate-modal');
        $this->dispatch('refresh-stall-rates');
    }
    public function render()
    {
        return view('livewire.main.stall.stall-rate-update');
    }
}

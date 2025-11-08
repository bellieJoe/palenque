<?php

namespace App\Livewire\Main\Stall;

use App\Models\Stall;
use App\Models\StallRate;
use Livewire\Attributes\Validate;
use Livewire\Component;

class StallEdit extends Component
{
    protected $listeners = [
        'editStall' => 'editStall'
    ];
    public $stallRates;
    public $stall;
    #[Validate('required|max:255')]
    public $name;
    #[Validate('required')]
    public $stall_rate;
    #[Validate('required')]
    public $area;

    public function editStall($id)
    {
        $stall = Stall::find($id);
        $this->stall = $stall;
        $this->name = $stall->name;
        $this->area = $stall->area;
        $this->stall_rate = $stall->stall_rate_id;
        $this->dispatch('show-edit-stall-modal');
    }
    
    public function updateStall()
    {
        $this->validate();
        $this->stall->name = $this->name;
        $this->stall->stall_rate_id = $this->stall_rate;
        $this->stall->area = $this->area;
        $this->stall->save();
        notyf()->position('y', 'top')->success('Stall updated successfully!');
        $this->dispatch('hide-edit-stall-modal');
        $this->dispatch('refresh-stalls');
        $this->reset(['name', 'stall_rate', 'area']);
    }
    
    public function render()
    {
        return view('livewire.main.stall.stall-edit');
    }

    public function mount()
    {
        $this->stallRates = StallRate::all();
    }
}

<?php

namespace App\Livewire\Main\Stall;

use App\Models\Stall;
use Livewire\Attributes\Validate;
use Livewire\Component;

class StallEdit extends Component
{
    protected $listeners = [
        'editStall' => 'editStall'
    ];

    public $stall;
    #[Validate('required|max:255')]
    public $name;

    public function editStall($id)
    {
        $stall = Stall::find($id);
        $this->stall = $stall;
        $this->name = $stall->name;
        $this->dispatch('show-edit-stall-modal');
    }
    
    public function updateStall()
    {
        $this->validate();
        $this->stall->name = $this->name;
        $this->stall->save();
        notyf()->position('y', 'top')->success('Stall updated successfully!');
        $this->dispatch('hide-edit-stall-modal');
        $this->dispatch('refresh-stalls');
    }
    
    public function render()
    {
        return view('livewire.main.stall.stall-edit');
    }
}

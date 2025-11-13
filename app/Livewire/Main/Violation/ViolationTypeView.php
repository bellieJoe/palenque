<?php

namespace App\Livewire\Main\Violation;

use App\Models\ViolationType;
use Livewire\Component;

class ViolationTypeView extends Component
{
    public $violationType;
    public function mount($id)
    {
        $this->violationType = ViolationType::find($id);
    }

    public function render()
    {
        return view('livewire.main.violation.violation-type-view');
    }
}

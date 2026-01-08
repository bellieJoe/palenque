<?php

namespace App\Livewire\Main\Violation;

use App\Models\ViolationType;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ViolationTypeEdit extends Component
{
    public $violationType;
    #[Validate('required|max:255')]
    public $name = "";
    // #[Validate('required|max:255')]
    // public $code = "";
    #[Validate('required|in:MONETARY,SERVICE')]
    public $penalty_type = "";
    #[Validate('nullable|required_if:penalty_type,MONETARY')]
    public $penalty_amount;
    #[Validate('nullable|required_if:penalty_type,service|max:5000')]
    public $penalty_service;

    public function mount($id)
    {
        $this->violationType = ViolationType::find($id);
        $this->name = $this->violationType->name;
        // $this->code = $this->violationType->code;
        $this->penalty_type = $this->violationType->penalty_type;
        $this->penalty_amount = $this->violationType->monetary_penalty;
        $this->penalty_service = $this->violationType->service_penalty;
    }

    public function saveViolationType()
    {
        $this->validate();
        $this->violationType->update([
            "name" => $this->name,
            // "code" => $this->code,
            "penalty_type" => $this->penalty_type,
            "monetary_penalty" => $this->penalty_type ? $this->penalty_amount : null,
            "service_penalty" => $this->penalty_type ? $this->penalty_service : null
        ]);
        notyf()->position('y', 'top')->success('Violation type updated successfully!');
        $this->redirectRoute('main.violations.types.index');
    }

    public function render()
    {
        return view('livewire.main.violation.violation-type-edit');
    }
}

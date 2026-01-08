<?php

namespace App\Livewire\Main\Violation;

use App\Models\ViolationType;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ViolationTypeCreate extends Component
{
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

    public function storeViolationType(){
        $this->validate();
        ViolationType::create([
            "name" => $this->name,
            // "code" => $this->code,
            "penalty_type" => $this->penalty_type,
            "monetary_penalty" => $this->penalty_type ? $this->penalty_amount : null,
            "service_penalty" => $this->penalty_type ? $this->penalty_service : null,
            "municipal_market_id" => auth()->user()->marketDesignation()->id
        ]);
        notyf()->position('y', 'top')->success('Violation type created successfully!');
        $this->redirectRoute('main.violations.types.index');
    }
    
    public function render()
    {
        return view('livewire.main.violation.violation-type-create');
    }
}

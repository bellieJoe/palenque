<?php

namespace App\Livewire\Main\Violation;

use App\Models\StallOccupant;
use App\Models\Vendor;
use App\Models\Violation;
use App\Models\ViolationType;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ViolationCreate extends Component
{
    public $stalls;
    public $violationTypes;
    public $vendor;
    #[Validate('required|exists:violation_types,id')]
    public $violation;
    #[Validate('required|exists:stalls,id')]
    public $stall;

    public function storeViolation()
    {
        $this->validate();
        $stallOccupant = StallOccupant::where("vendor_id", $this->vendor->id)->where("stall_id", $this->stall)->first();
        Violation::create([
            "vendor_id" => $this->vendor->id,
            "violation_type_id" => $this->violation,
            "stall_occupant_id" => $stallOccupant->id,
            "municipal_market_id" => auth()->user()->marketDesignation()->id
        ]);
        notyf()->position('y', 'top')->success('Violation created successfully!');
        $this->redirectRoute('main.violations.index');
    }

    public function mount($vendor_id)
    {
        $this->vendor = Vendor::find($vendor_id);
        $this->stalls = $this->vendor->stallOccupants;
        $this->violationTypes = ViolationType::where('municipal_market_id', auth()->user()->marketDesignation()->id)->get();
    }

    public function render()
    {
        return view('livewire.main.violation.violation-create');
    }
}

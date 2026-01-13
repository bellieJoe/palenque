<?php

namespace App\Livewire\Main\Violation;

use App\Models\StallOccupant;
use App\Models\Vendor;
use App\Models\Violation;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ViolationView extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $stallOccupant;
    protected $listeners = ['refresh-violations' => 'refreshViolations'];
    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function refreshViolations()
    {
        
    }

    public function waiveViolation($violationId)
    {
         Violation::find($violationId)->update([
            "status" => "WAIVED"
        ]);
    }

    public function resolveViolation($violationId)
    {
        Violation::find($violationId)->update([
            "status" => "RESOLVED"
        ]);
    }

    public function mount($stallOccupantId)
    {
        $stallOccupant = StallOccupant::find($stallOccupantId);
        $this->stallOccupant = StallOccupant::where('id', $stallOccupantId)->with(['violations' => function ($query) { 
            $query->with('violationType'); 
        }])->first();
    }

    public function render()
    {
        $violations = Violation::where('stall_occupant_id', $this->stallOccupant->id)
        ->whereHas('violationType', function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })
        ->with(['violationType'])
        ->orderBy('status', 'desc')
        ->paginate(20);
        return view('livewire.main.violation.violation-view', [
            'violations' => $violations
        ]);
    }
}

<?php

namespace App\Livewire\Main\Violation;

use App\Models\ViolationType;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ViolationTypeIndex extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $listeners = [
        "refresh-violation-types"
    ];

    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function deleteViolationType($id){
        ViolationType::find($id)->delete();
    }
    
    public function render()
    {
        $violationTypes = ViolationType::query()->where('name', 'like', '%' . $this->search . '%')->where('municipal_market_id', auth()->user()->marketDesignation()->id)->paginate(10);
        return view('livewire.main.violation.violation-type-index', [
            'violationTypes' => $violationTypes
        ]);
    }
}

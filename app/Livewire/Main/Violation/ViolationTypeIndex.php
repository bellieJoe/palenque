<?php

namespace App\Livewire\Main\Violation;

use App\Models\ViolationType;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

use function Flasher\Notyf\Prime\notyf;

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
        ViolationType::find($id)->update([
            "restore_date" => now()->addDays(60)->format('Y-m-d')
        ]);
        ViolationType::find($id)->delete(); 
        notyf()->position('y', 'top')->success('Violation Type Deleted');
    }

    public function restoreViolationType($id){
        ViolationType::withTrashed()->find($id)->update([
            "restore_date" => null
        ]);
        ViolationType::withTrashed()->find($id)->restore();
        notyf()->position('y', 'top')->success('Violation Type Restored');
    }
    
    public function render()
    {
        $violationTypes = ViolationType::query()
        ->withTrashed()
        ->where(function ($q) {
            $q->whereNull('deleted_at') // active records (ignore restore_date)
            ->orWhere(function ($q) {
                $q->whereNotNull('deleted_at') // deleted records
                    ->whereDate('restore_date', '>', today());
            });
        })
        ->where('name', 'like', '%' . $this->search . '%')
        ->where('municipal_market_id', auth()->user()->marketDesignation()->id)
        ->orderBy("restore_date", "asc")
        ->paginate(10);
        return view('livewire.main.violation.violation-type-index', [
            'violationTypes' => $violationTypes
        ]);
    }
}

<?php

namespace App\Livewire\Main\Violation;

use App\Models\Stall;
use App\Models\StallContract;
use App\Models\StallOccupant;
use App\Models\Vendor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ViolationIndex extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $listeners = [
        "refresh-violations"
    ];
    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function terminateContract($stallOccupantId)
    {
        DB::transaction(function () use ($stallOccupantId) {
            try {
                $stallOccupant = StallOccupant::find($stallOccupantId);
                $stallOccupant->status = 0;
                $stallOccupant->save();
                StallContract::where([
                    'stall_occupant_id' => $stallOccupantId,
                ])->update([
                    'status' => 'TERMINATED'
                ]);
                notyf()->position('y', 'top')->success('Contract terminated successfully!');
                $this->refresh();
            } catch (\Throwable $th) {
                DB::rollBack();
                notyf()->position('y', 'top')->error('Something went wrong while terminating the contract!');
            }
        });
    }

    public function render()
    {
        $vendors = Vendor::query()->where("name", "like", "%{$this->search}%")
            ->where("municipal_market_id", auth()->user()->marketDesignation()->id)
            // ->with([])
            ->paginate(10);
        $stallOccupants = StallOccupant::whereHas("vendor", function($query) {
            $query->where("municipal_market_id", auth()->user()->marketDesignation()->id);
        })
        ->orderBy("vendor_id", "asc")
        ->paginate(10);
        Log::info($stallOccupants);
        return view('livewire.main.violation.violation-index', [
            'vendors' => $vendors,
            "stallOccupants" => $stallOccupants
        ]);
    }
}

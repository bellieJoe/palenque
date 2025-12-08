<?php

namespace App\Livewire\Main\Fee;

use App\Models\Fee;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class FeesIndex extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $listeners = [
        "refresh-fees"
    ];
    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function waive($id)
    {
        $fee = Fee::find($id);
        $fee->update([
            "status" => "WAIVED"
        ]);
        notyf()->position('y', 'top')->success('Ticket waived successfully!');
    }

    public function render()
    {
        Gate::authorize('viewAny', Fee::class);
        $marketId = auth()->user()->marketDesignation()->id;
        $fees = Fee::query()
            ->where("municipal_market_id", $marketId)
            ->where('fee_type', "stall")
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->whereHas("stallOccupant.vendor", fn($v) =>
                        $v->where("name", "like", "%{$this->search}%")
                    )
                    ->orWhereHas("supplier", fn($s) =>
                        $s->where("name", "like", "%{$this->search}%")
                    );
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('livewire.main.fee.fees-index', [
            'fees' => $fees
        ]);
    }
}

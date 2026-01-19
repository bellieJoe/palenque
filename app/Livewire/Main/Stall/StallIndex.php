<?php

namespace App\Livewire\Main\Stall;

use App\Models\Stall;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class StallIndex extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $listeners = [
        'refresh-stalls'
    ];
    
    public $search;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function restoreStall($id)
    {
        $stall = Stall::withTrashed()->find($id);
        $stall->update(['restore_date' => null]);
        $stall->restore();
        notyf()->position('y', 'top')->success('Stall restored successfully!');
    }

    public function deleteStall($id)
    {
        $stall = Stall::find($id);
        $stall->update(['restore_date' => now()->addDays(60)->format('Y-m-d')]);
        $stall->delete();
        notyf()->position('y', 'top')->success('Stall deleted successfully!');
    }

    public function editStall($id)
    {
        $this->dispatch('editStall', $id);
    }

    public function setOccupant($id)
    {
        $this->dispatch('setOccupant', $id);
    }

    public function render()
    {
        Gate::authorize('viewAny', Stall::class);
        $stalls = Stall::query()
        ->withTrashed()
        ->with('stallRate', function($query) {
            $query->withTrashed();
        })
        ->where(function ($q) {
            $q->whereNull('deleted_at') // active records (ignore restore_date)
            ->orWhere(function ($q) {
                $q->whereNotNull('deleted_at') // deleted records
                    ->whereDate('restore_date', '>', today());
            });
        })
        ->where('name', 'like', '%' . $this->search . '%')
        ->where('municipal_market_id', auth()->user()->marketDesignation()->id)
        ->paginate(10);
        $counts = [
            "total_stalls" => Stall::where('municipal_market_id', auth()->user()->marketDesignation()->id)->count(),
            "available_stalls" => Stall::where('municipal_market_id', auth()->user()->marketDesignation()->id)
            ->whereDoesntHave('stallOccupants', function ($query) {
                $query->whereHas('stallContracts', function ($query) {
                    $query->whereDate('from', '<=', now())
                        ->whereDate('to', '>=', now());
                });
            })
            ->count()
        ];
        return view('livewire.main.stall.stall-index', [
            'stalls' => $stalls,
            'counts' => $counts
        ]);
    }
}

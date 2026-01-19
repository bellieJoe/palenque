<?php

namespace App\Livewire\Main\Stall;

use App\Models\StallRate;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class StallRateIndex extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $listeners = ['refresh-stall-rates'];
    protected $paginationTheme = 'bootstrap';
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function restoreStallRate($stallRateId)
    {
        $stallRate = StallRate::withTrashed()->find($stallRateId);
        $stallRate->update(['restore_date' => null]);
        $stallRate->restore();
        notyf()->position('y', 'top')->success('Stall Rate restored successfully!');
    }

    public function deleteStallRate($stallRateId)
    {
        $stallRate = StallRate::find($stallRateId);
        $stallRate->update(['restore_date' => now()->addDays(60)->format('Y-m-d')]);
        $stallRate->delete();
        notyf()->position('y', 'top')->success('Stall Rate deleted successfully!');
    }

    public function editStallRate($stallRateId)
    {
        $this->dispatch('editStallRate', $stallRateId);
    }

    public function render()
    {
        Gate::authorize('viewAny', StallRate::class);
        $stallRates = StallRate::query()
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
        ->orderBy('restore_date', 'asc')
        ->paginate(10);
        return view('livewire.main.stall.stall-rate-index', [
            'stallRates' => $stallRates
        ]);
    }
}

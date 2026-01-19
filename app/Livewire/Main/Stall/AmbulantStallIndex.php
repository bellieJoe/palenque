<?php

namespace App\Livewire\Main\Stall;

use App\Models\AmbulantStall;
use App\Models\Fee;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class AmbulantStallIndex extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function restoreAmbulantStall($id)
    {
        AmbulantStall::withTrashed()->find($id)->update(['restore_date' => null]);
        AmbulantStall::withTrashed()->find($id)->restore();
        notyf()->position('y', 'top')->success('Ambulant Stall restored successfully!');
    }

    public function deleteAmbulantStall($id)
    {
        if(
            Fee::where("owner_id", $id)->where("fee_type", "STALL")->exists()
        )
        {
            return notyf()->position('y', 'top')->error('Ambulant Stall already has data!');
        }
        AmbulantStall::withTrashed()->find($id)->update(['restore_date' => now()->addDays(60)->format('Y-m-d')]);
        AmbulantStall::find($id)->delete();
        notyf()->position('y', 'top')->success('Ambulant Stall deleted successfully!');
    }


    public function render()
    { 
        Gate::authorize('viewAny', AmbulantStall::class);
        $ambulantStalls = AmbulantStall::query()
        ->withTrashed()
        ->whereHas('vendor')
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
        ->paginate(20);
        return view('livewire.main.stall.ambulant-stall-index', [
            'ambulantStalls' => $ambulantStalls
        ]);
    }
}

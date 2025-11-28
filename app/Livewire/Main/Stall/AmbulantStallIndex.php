<?php

namespace App\Livewire\Main\Stall;

use App\Models\AmbulantStall;
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

    public function deleteAmbulantStall($id)
    {
        AmbulantStall::find($id)->delete();
        notyf()->position('y', 'top')->success('Ambulant Stall deleted successfully!');
    }


    public function render()
    { 
        Gate::authorize('viewAny', AmbulantStall::class);
        $ambulantStalls = AmbulantStall::where('name', 'like', '%' . $this->search . '%')
        ->where('municipal_market_id', auth()->user()->marketDesignation()->id)
        ->paginate(20);
        return view('livewire.main.stall.ambulant-stall-index', [
            'ambulantStalls' => $ambulantStalls
        ]);
    }
}

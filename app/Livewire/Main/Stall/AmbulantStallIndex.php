<?php

namespace App\Livewire\Main\Stall;

use App\Models\AmbulantStall;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class AmbulantStallIndex extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $seacrh = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    { 
        $ambulantStalls = AmbulantStall::where('name', 'like', '%' . $this->search . '%')
        ->where('municipal_market_id', auth()->user()->municipal_market_id)
        ->paginate(20);
        return view('livewire.main.stall.ambulant-stall-index', [
            'ambulantStalls' => $ambulantStalls
        ]);
    }
}

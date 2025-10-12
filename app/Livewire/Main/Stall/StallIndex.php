<?php

namespace App\Livewire\Main\Stall;

use App\Models\Stall;
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

    public function deleteStall($id)
    {
        $stall = Stall::find($id);
        $stall->delete();
        notyf()->position('y', 'top')->success('Stall deleted successfully!');
    }

    public function editStall($id)
    {
        $this->dispatch('editStall', $id);
    }

    public function render()
    {
        $stalls = Stall::query()->where('name', 'like', '%' . $this->search . '%')->where('municipal_market_id', auth()->user()->marketDesignation()->id)->paginate(10);
        return view('livewire.main.stall.stall-index', [
            'stalls' => $stalls
        ]);
    }
}

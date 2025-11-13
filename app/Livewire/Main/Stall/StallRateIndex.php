<?php

namespace App\Livewire\Main\Stall;

use App\Models\StallRate;
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

    public function deleteStallRate($stallRateId)
    {
        $stallRate = StallRate::find($stallRateId);
        $stallRate->delete();
        notyf()->position('y', 'top')->success('Stall Rate deleted successfully!');
    }

    public function editStallRate($stallRateId)
    {
        $this->dispatch('editStallRate', $stallRateId);
    }

    public function render()
    {
        $stallRates = StallRate::query()->where('name', 'like', '%' . $this->search . '%')->where('municipal_market_id', auth()->user()->marketDesignation()->id)->paginate(10);
        return view('livewire.main.stall.stall-rate-index', [
            'stallRates' => $stallRates
        ]);
    }
}

<?php

namespace App\Livewire\Dashboard;

use App\Models\Item;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class FishSupply extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $startFilter;
    public $endFilter;

    public function updatingStartFilter()
    {
        $this->resetPage();
    }

    public function updatingEndFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $items = Item::where('municipal_market_id', auth()->user()->marketDesignation()->id)
        ->whereHas("itemCategory", function ($q){
            $q->where("is_fish", true);
        })
        ->get();
        return view('livewire.dashboard.fish-supply', compact('items'));
    }
}

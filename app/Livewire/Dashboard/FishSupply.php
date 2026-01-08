<?php

namespace App\Livewire\Dashboard;

use App\Models\Item;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class FishSupply extends Component
{
    use WithPagination, WithoutUrlPagination;
    
    public $startFilter;
    public $endFilter;
    public $data;


    public function updatingStartFilter()
    {
        $this->init();
        $this->resetPage();
    }

    public function updatingEndFilter()
    {
        $this->init();
        $this->resetPage();
    }

    public function mount(){
        $this->startFilter = Carbon::parse(date('Y')."-01-01")->format('Y-m-d');
        $this->endFilter = Carbon::parse(date('Y')."-12-31")->format('Y-m-d');
    }

    private function init()
    {
        $this->data = Item::where('municipal_market_id', auth()->user()->marketDesignation()->id)
            ->whereHas("itemCategory", function($q) {
                $q->where("name", "Fish");
            })
            // ✅ correct relationship path
            ->whereHas('delivery_items.delivery', function ($query) {
                $query->whereBetween('delivery_date', [
                    $this->startFilter,
                    $this->endFilter
                ]);
            })

            // ✅ sum SALES from delivery_items
            ->withSum([
                'delivery_items as sales_total' => function ($query) {
                    $query->whereHas('delivery', function ($q) {
                        $q->whereBetween('delivery_date', [
                            $this->startFilter,
                            $this->endFilter
                        ]);
                    });
                }
            ], 'base_amount')

            ->orderByDesc('sales_total')
            ->limit(10)
            ->get()

            ->map(function ($item) {
                return [
                    'x' => $item->name,
                    'y' => (int) ($item->sales_total ?? 0)
                ];
            });
    }


    public function updateData(){
        $this->init();
    }

    public function render()
    {
        $this->init();
        $items = Item::where('municipal_market_id', auth()->user()->marketDesignation()->id)
        ->whereHas("itemCategory", function ($q){
            $q->where("is_fish", true);
        })
        ->get();
        return view('livewire.dashboard.fish-supply', compact('items'));
    }
}

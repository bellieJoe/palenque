<?php

namespace App\Livewire\Dashboard;

use App\Models\Item;
use App\Models\ItemCategory;
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
    public $productFilter;
    public $categories;
    public $data;


    public function updatingProductFilter()
    {
        $this->resetPage();
        $this->updateData();
    }

    public function updatingStartFilter()
    {
        // $this->init();
        $this->resetPage();
        $this->updateData();
    }

    public function updatingEndFilter()
    {
        // $this->init();
        $this->resetPage();
        $this->updateData();
    }

    public function mount(){
        $this->startFilter = Carbon::parse(date('Y')."-01-01")->format('Y-m-d');
        $this->endFilter = Carbon::parse(date('Y')."-12-31")->format('Y-m-d');
        $this->productFilter = 1;
        $this->categories = ItemCategory::all();
    }

    private function init()
    {
        $this->data = Item::where('municipal_market_id', auth()->user()->marketDesignation()->id)
            ->whereHas("itemCategory", function($q) {
                $q->where("id", $this->productFilter);
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
        $this->dispatch('updateData', [
            'data' => $this->data
        ]);
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

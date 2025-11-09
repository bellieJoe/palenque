<?php

namespace App\Livewire\Main\Goods;

use App\Models\DeliveryItem;
use App\Models\Item;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class DeliveryCreate extends Component
{
    public $suppliers;
    public array $items = [];
    public $itemOptions;
    public $unitOptions;

    public function addItem()
    {
        $this->items[] = [
            'item_id' => null,
            'quantity' => null,
            'unit_id' => null,
            'tax' => null,
            'ticket_no' => null
        ];
    }

    public function updatingItems($value)
    {
        Log::info($this->items);
    }

    public function removeItem($key)
    {
        unset($this->items[$key]);
        $this->items = array_values($this->items); // reindex
    }

    public function mount()
    {
        $this->suppliers = Supplier::where('municipal_market_id', auth()->user()->marketDesignation()->id)->get();
        $this->itemOptions = Item::where('municipal_market_id', auth()->user()->marketDesignation()->id)->get();
        $this->unitOptions = Unit::where('municipal_market_id', auth()->user()->marketDesignation()->id)->get();
    }

    public function render()
    {
        return view('livewire.main.goods.delivery-create');
    }
}

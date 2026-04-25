<?php

namespace App\Livewire\Main\Goods;

use App\Models\DeliveryTicket;
use App\Models\Item;
use App\Models\MonthlyRent;
use App\Models\VendorPrice;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class PriceMonitoringIndex extends Component
{
    use WithoutUrlPagination, WithPagination;
    public $search;

    

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function approve($id)
    {
        $price = VendorPrice::find($id);
        $price->status = 'approved';
        $price->save();
        notyf()->position('y', 'top')->success('Price approved successfully!');
    }

    public function render()
    {
        $pendingPrices = VendorPrice::where('status', 'pending')->where('municipal_market_id', auth()->user()->marketDesignation()->id)->get();
        $items = Item::where("municipal_market_id", auth()->user()->marketDesignation()->id)
        ->where("name", "like", "%{$this->search}%")
        ->paginate(50);
        return view('livewire.main.goods.price-monitoring-index', [
            'items' => $items,
            'pendingPrices' => $pendingPrices
        ]);
    }
}

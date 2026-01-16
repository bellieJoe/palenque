<?php

namespace App\Livewire\Vendor\PriceMonitoring;

use App\Models\Item;
use App\Models\VendorPrice;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

use function Flasher\Notyf\Prime\notyf;

class PriceMonitoringIndex extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $date;
    public $search;
    public $items = [];

    public function mount()
    {
        $this->date = now()->toDateString();

        $this->loadPrices();
    }

    public function updatedDate()
    {
        $this->loadPrices();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    /**
     * Catch ALL item price updates
     */
    public function updated($name, $value)
    {
        if (! str_starts_with($name, 'items.')) {
            return;
        }

        $itemId = str_replace('items.', '', $name);

        VendorPrice::updateOrCreate(
            [
                'vendor_id' => auth()->user()->vendor->id,
                'item_id' => $itemId,
                'date' => $this->date,
                'municipal_market_id' => auth()->user()->marketDesignation()->id,
            ],
            [
                'price' => $value ?? 0,
            ]
        );
        notyf()->position('y', 'top')->success('Price updated successfully!');
    }

    /**
     * Load prices ONLY when needed
     */
    protected function loadPrices()
    {
        $prices = VendorPrice::where('vendor_id', auth()->user()->vendor->id)
            ->whereDate('date', $this->date)
            ->get()
            ->keyBy('item_id');

        $items = Item::where('municipal_market_id', auth()->user()->marketDesignation()->id)
            ->get();

        $this->items = [];

        foreach ($items as $item) {
            $this->items[$item->id] = $prices[$item->id]->price ?? 0;
        }
    }

    public function render()
    {
        return view('livewire.vendor.price-monitoring.price-monitoring-index', [
            'wetGoods' => Item::where('type', 'WET')
                ->where('municipal_market_id', auth()->user()->marketDesignation()->id)
                ->where('name', 'like', "%{$this->search}%")
                ->get(),

            'dryGoods' => Item::where('type', 'DRY')
                ->where('municipal_market_id', auth()->user()->marketDesignation()->id)
                ->where('name', 'like', "%{$this->search}%")
                ->get(),
        ]);
    }
}

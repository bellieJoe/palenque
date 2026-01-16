<?php

namespace App\Livewire\Main\Goods;

use App\Models\Item;
use App\Models\PriceMonitoringRecord;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class PriceHistoryChart extends Component
{
    public $startFilter;
    public $endFilter;
    public $typeFilter;
    public $itemFilter;
    public $itemOptions = [];

    public $series = [];
    public $seriesName = 'Price';
    
    public function mount()
    {
        $this->typeFilter = "WET";
        $this->itemOptions = Item::where('type', $this->typeFilter)
            ->where('municipal_market_id', auth()->user()->marketDesignation()->id)
            ->get();
        $this->itemFilter = $this->itemOptions[0]->id;
        $this->startFilter = Carbon::parse(date('Y') . "-01-01")->format('Y-m-d');
        $this->endFilter = Carbon::parse(date('Y') . "-12-31")->format('Y-m-d');
        $this->updateChartData();
    }

    public function updatedTypeFilter($value)
    {
        $this->itemFilter = null; // reset item when type changes
        $this->itemOptions = Item::where('type', $value)
            ->where('municipal_market_id', auth()->user()->marketDesignation()->id)
            ->get();
    }

    public function updatedItemFilter()
    {
        $this->updateChartData();
    }

    public function updatedStartFilter()
    {
        $this->updateChartData();
    }

    public function updatedEndFilter()
    {
        $this->updateChartData();
    }

    private function getMonthsArray($start, $end)
    {
        if (!$start || !$end) return [];
        $months = [];
        $startDate = Carbon::parse($start)->startOfMonth();
        $endDate = Carbon::parse($end)->startOfMonth();

        while ($startDate->lte($endDate)) {
            $months[] = $startDate->format('M Y');
            $startDate->addMonth();
        }
        return $months;
    }

    private function updateChartData()
    {
        if (!$this->itemFilter) return;

        $records = PriceMonitoringRecord::where('item_id', $this->itemFilter)
            ->whereBetween('created_at', [$this->startFilter, $this->endFilter])
            ->orderBy('date')
            ->get();

        // Format series for candlestick
        $this->series = $records->map(function($record) {
            return [
                'x' => $record->date->format('Y-m-d'),
                'y' => [
                    $record->price,       // open
                    $record->price_max,   // high
                    $record->price,       // low
                    $record->price_max    // close
                ]
            ];
        })->toArray();
        Log::info($this->series);

        // Dispatch to Alpine/ApexCharts
        $this->dispatch('updatePriceHistoryChart', [
            'data' => $this->series
        ]);
    }

    public function render()
    {
        return view('livewire.main.goods.price-history-chart', [
            'itemOptions' => $this->itemOptions
        ]);
    }
}

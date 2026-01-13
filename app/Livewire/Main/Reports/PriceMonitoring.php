<?php

namespace App\Livewire\Main\Reports;

use App\Models\Item;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class PriceMonitoring extends Component
{
    use WithPagination, WithoutUrlPagination;
    #[Validate('required|in:Daily,Monthly,Yearly,Weekly')]
    public $reportType = 'Daily';
    public $collectionDate = null;
    public $collectionMonth = null;
    public $collectionYear = null;
    public $collectionWeek = null;

    public function updatingReportType()
    {
        $this->collectionDate = now()->format('Y-m-d');
        $this->collectionMonth = now()->format('Y-m');
        $this->collectionYear = now()->format('Y');
    }

    public function mount()
    {
        $this->collectionDate = now()->format('Y-m-d');
        $this->collectionMonth = now()->format('Y-m-d');
        $this->collectionYear = now()->format('Y');
        $this->collectionWeek = now()->format('Y-m-d');
    }

    public function updating($name, $value)
    {
        $properties = ['collectionDate', 'collectionMonth', 'collectionYear'];

        if (in_array($name, $properties)) {
            foreach ($properties as $prop) {
                if ($prop !== $name) {
                    $this->$prop = null;
                }
            }
        }

        if ($name === 'reportType') {
            foreach ($properties as $prop) {
                $this->$prop = null;
            }
        }

        $this->resetPage();
    }
    public function render()
    {
        $items = Item::where('municipal_market_id', auth()->user()->marketDesignation()->id)
            ->with(['priceMonitoringRecords' => function ($query) {

                // Daily
                if ($this->reportType === 'Daily') {
                    $query->whereDate('date', $this->collectionDate);
                }

                // Monthly
                if ($this->reportType === 'Monthly') {
                    $query->whereMonth('date', Carbon::parse($this->collectionMonth)->format('m'))
                        ->whereYear('date', Carbon::parse($this->collectionMonth)->format('Y'));
                }

                // Yearly
                if ($this->reportType === 'Yearly') {
                    $query->whereYear('date', $this->collectionYear);
                }

                // Group by latest record per unit
                $query->orderBy('unit_id')
                    ->orderByDesc('date');

            }, 'priceMonitoringRecords.unit'])
            ->get();

        // After loading, filter in PHP for latest records only
        $items->each(function ($item) {
            $item->priceMonitoringRecords = $item->priceMonitoringRecords
                ->unique('unit_id')
                ->values();
        });

        return view('livewire.main.reports.price-monitoring', [
            'items' => $items
        ]);
    }
}

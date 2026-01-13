<?php

namespace App\Livewire\Main\Reports;

use App\Models\Item;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class FishMonitoring extends Component
{
    use WithPagination, WithoutUrlPagination;
    #[Validate('required|in:Daily,Monthly,Yearly')]
    public $reportType = 'Daily';
    public $collectionDate;
    public $collectionMonth;
    public $collectionYear;

    public function updatingReportType()
    {
        $this->collectionDate = now()->format('Y-m-d');
        $this->collectionMonth = now()->format('Y-m');
        $this->collectionYear = now()->format('Y');
    }

     public function updating($name, $value)
    {
        $properties = ['collectionDate', 'collectionMonth', 'collectionYear', 'reportType'];
        
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

    public function mount()
    {
        $this->collectionDate = now()->format('Y-m-d');
        $this->collectionMonth = now()->format('Y-m');
        $this->collectionYear = now()->format('Y');
    }
    
    public function render()
    {
        $this->collectionDate = now()->format('Y-m-d');
        $this->collectionMonth = now()->format('Y-m');
        $this->collectionYear = now()->format('Y');
        // $data = Item::query()
        // ->join('delivery_items', 'delivery_items.item_id', '=', 'items.id')
        // ->whereHas('itemCategory', fn ($q) => $q->where('name', 'Fish'))
        // ->whereHas('deliveryItems.delivery', function ($q) {
        //     $q->whereDate('delivery_date', $this->collectionDate);
        // })
        // ->select([
        //     'items.id',
        //     'items.name',
        //     'items.created_at',
        // ])
        // ->selectRaw('SUM(delivery_items.base_amount) AS total')
        // ->groupBy(
        //     'items.id',
        //     'items.name',
        //     'items.created_at'
        // )
        // ->orderBy('items.created_at', 'desc')
        // ->paginate(20);

        // $dataLocal = Item::query()
        // ->join('delivery_items', 'delivery_items.item_id', '=', 'items.id')
        // ->join('origins', 'origins.id', '=', 'delivery_items.origin')
        // ->whereHas('itemCategory', fn ($q) => $q->where('name', 'Fish'))
        // ->whereHas('deliveryItems.delivery', function ($q) {
        //     $q->whereDate('delivery_date', $this->collectionDate);
        // })
        // ->select([
        //     'items.id as item_id',
        //     'items.name as item_name',
        //     'items.created_at',
        //     'origins.id as origin_id',
        //     'origins.name as origin_name',
        // ])
        // ->selectRaw('SUM(delivery_items.base_amount) AS total')
        // ->groupBy(
        //     'items.id',
        //     'items.name',
        //     'items.created_at',
        //     'origins.id',
        //     'origins.name'
        // )
        // ->orderBy('items.created_at', 'desc')
        // ->paginate(20);

        $dataLocal = Item::query()
        ->join('delivery_items', 'delivery_items.item_id', '=', 'items.id')
        ->join('origins', 'origins.id', '=', 'delivery_items.origin')
        ->whereHas('itemCategory', fn ($q) => $q->where('name', 'Fish'))
        ->whereHas('deliveryItems.delivery', function ($q) {
            $q->whereDate('delivery_date', $this->collectionDate);
        })
        ->where('origins.is_local', true)
        ->select([
            'items.id as item_id',
            'items.name as item_name',
            'items.created_at',
            'origins.id as origin_id',
            'origins.name as origin_name',
        ])
        ->selectRaw('SUM(delivery_items.base_amount) AS total')
        ->groupBy(
            'items.id',
            'items.name',
            'items.created_at',
            'origins.id',
            'origins.name'
        )
        ->orderBy('items.created_at', 'desc')
        ->get();

        $dataImport = Item::query()
        ->join('delivery_items', 'delivery_items.item_id', '=', 'items.id')
        ->join('origins', 'origins.id', '=', 'delivery_items.origin')
        ->whereHas('itemCategory', fn ($q) => $q->where('name', 'Fish'))
        ->whereHas('deliveryItems.delivery', function ($q) {
            $q->whereDate('delivery_date', $this->collectionDate);
        })
        ->where('origins.is_local', false)
        ->select([
            'items.id as item_id',
            'items.name as item_name',
            'items.created_at',
            'origins.id as origin_id',
            'origins.name as origin_name',
        ])
        ->selectRaw('SUM(delivery_items.base_amount) AS total')
        ->groupBy(
            'items.id',
            'items.name',
            'items.created_at',
            'origins.id',
            'origins.name'
        )
        ->orderBy('items.created_at', 'desc')
        ->get();


        return view('livewire.main.reports.fish-monitoring', [
            "dataLocal" => $dataLocal,
            "dataImport" => $dataImport
        ]);
    }
}

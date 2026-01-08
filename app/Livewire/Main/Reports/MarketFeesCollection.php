<?php

namespace App\Livewire\Main\Reports;

use App\Models\Delivery;
use App\Models\DeliveryTicket;
use App\Models\Fee;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class MarketFeesCollection extends Component
{
    use WithPagination, WithoutUrlPagination;
    #[Validate('required|in:Daily,Monthly,Yearly')]
    public $reportType = 'Daily';
    public $collectionDate = null;
    public $collectionMonth = null;
    public $collectionYear = null;

    public function mount()
    {
        $this->collectionDate = now()->format('Y-m-d');
        $this->collectionMonth = now()->format('Y-m');
        $this->collectionYear = now()->format('Y');
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
        $feeCollections = DeliveryTicket::query()
        ->where('municipal_market_id', auth()->user()->marketDesignation()->id)
        ->where('status', 'PAID')
        ->when($this->reportType == 'Daily', function ($query) {
            $query->whereHas("deliveryItem", function($q){
                $q->whereHas("delivery", function($q){
                    $q->whereDate('delivery_date', $this->collectionDate);
                });
            });
        })
        ->when($this->reportType == 'Monthly', function ($query) {
            $query->whereHas("deliveryItem", function($q){
                $q->whereHas("delivery", function($q){
                    $q->whereMonth('delivery_date', Carbon::parse($this->collectionMonth)->format('m'))
                        ->whereYear('delivery_date', Carbon::parse($this->collectionMonth)->format('Y')); //->whereMonth('date_paid', $this->collectionMonth);
                });
            });
        })
        ->when($this->reportType == 'Yearly', function ($query) {
            $query->whereHas("deliveryItem", function($q){
                $q->whereHas("delivery", function($q){
                    $q->whereYear('delivery_date', $this->collectionYear);
                });
            });
        })
        ->get();
        $ambulantFees = Fee::query()
        ->where("fee_type", "STALL")
        ->when($this->reportType == 'Daily', function ($query) {
            $query->whereDate('date_issued', $this->collectionDate);
        })
        ->when($this->reportType == 'Monthly', function ($query) {
            $query
                ->whereMonth('date_issued', Carbon::parse($this->collectionMonth)->format('m'))
                ->whereYear('date_issued', Carbon::parse($this->collectionMonth)->format('Y')); //->whereMonth('date_issued', $this->collectionMonth);
        })
        ->when($this->reportType == 'Yearly', function ($query) {
            $query->whereYear('date_issued', $this->collectionYear);
        })
        ->get();
        return view('livewire.main.reports.market-fees-collection', [
            'feeCollections' => $feeCollections,
            'ambulantFees' => $ambulantFees
        ]);
    }
}

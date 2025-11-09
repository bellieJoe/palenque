<?php

namespace App\Livewire\Main\Goods;

use App\Models\Delivery;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class DeliveryIndex extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $fromFilter;
    public $toFilter;

    public function updatingFromFilter()
    {
        $this->resetPage();
    }
    
    public function updatingToFilter()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->fromFilter = now()->subDays(30)->format('Y-m-d');
        $this->toFilter = now()->format('Y-m-d');
    }

    public function render()
    {
        $deliveries = Delivery::whereBetween('delivery_date', [$this->fromFilter, $this->toFilter])->paginate(20);
        return view('livewire.main.goods.delivery-index', [
            'deliveries' => $deliveries
        ]);
    }
}

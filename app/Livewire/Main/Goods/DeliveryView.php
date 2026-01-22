<?php

namespace App\Livewire\Main\Goods;

use App\Models\Delivery;
use App\Models\DeliveryTicket;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class DeliveryView extends Component
{
    protected $listeners = [
        'refreshDelivery'
    ];
    public $delivery;

    public function waiveTicket($id)
    {
        DeliveryTicket::query()->find($id)->update([
            "status" => "WAIVED"
        ]);
        notyf()->position('y', 'top')->success('Ticket waived successfully!');
    }

    public function updateDeliveryTicketPayment($id)
    {
        $this->dispatch('updateDeliveryTicketPayment', $id);
    }
    
    public function mount($delivery_id)
    {
        $this->delivery = Delivery::query()
        ->with([
            "supplier" => function($q){
                $q->withTrashed();
                $q->with("origin", function($query){
                    $query->withTrashed();
                });
            },
            "deliveryItems.unit", 
            "deliveryItems.item"
        ])
        ->find($delivery_id);

        Log::info($this->delivery);
    }

    public function render()
    {
        return view('livewire.main.goods.delivery-view');
    }
}

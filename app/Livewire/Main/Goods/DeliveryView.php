<?php

namespace App\Livewire\Main\Goods;

use App\Models\Delivery;
use App\Models\DeliveryTicket;
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
        $this->delivery = Delivery::query()->with("deliveryItems.unit", "deliveryItems.item")->find($delivery_id);
    }

    public function render()
    {
        return view('livewire.main.goods.delivery-view');
    }
}

<?php

namespace App\Livewire\Main\Goods;

use App\Models\DeliveryTicket;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UpdateDeliveryTicketPayment extends Component
{
    protected $listeners = ['updateDeliveryTicketPayment' => 'showUpdateDeliveryPayment'];
    public $deliveryTicket; 
    #[Validate('required|date|before_or_equal:today')]
    public $date_paid;
    // #[Validate('required')]
    // public $receipt_no;

    public function showUpdateDeliveryPayment($id)
    {
        $this->date_paid = now()->format('Y-m-d');
        $this->deliveryTicket = DeliveryTicket::query()->find($id);
        $this->dispatch('show-update-delivery-payment-modal');
    }

    public function updatePayment()
    {
        $this->validate();
        $this->deliveryTicket->update([
            'date_paid' => $this->date_paid,
            // 'receipt_no' => $this->receipt_no,
            'status' => "PAID"
        ]);
        $this->dispatch('hide-update-delivery-payment-modal');
        $this->dispatch('refreshDelivery');
        $this->reset(['date_paid']);
        notyf()->position('y', 'top')->success('Payment updated successfully!');
    }

    
    public function render()
    {
        return view('livewire.main.goods.update-delivery-ticket-payment');
    }
}

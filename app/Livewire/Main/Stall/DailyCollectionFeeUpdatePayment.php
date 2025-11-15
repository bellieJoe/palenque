<?php

namespace App\Livewire\Main\Stall;

use App\Models\AmbulantStall;
use App\Models\Fee;
use Livewire\Attributes\Validate;
use Livewire\Component;

use function Flasher\Notyf\Prime\notyf;

class DailyCollectionFeeUpdatePayment extends Component
{
    public $fee;
    #[Validate('required')]
    public $receipt_no;
    public $remarks;
    #[Validate('required_if:status,PAID|date|before:tomorrow')]
    public $date_paid;
    public $vendor;
    public $ambulantStall;

    public function mount($fee_id)
    {
        $this->fee = Fee::find($fee_id);
        $this->date_paid = now();
        $this->ambulantStall = AmbulantStall::find($this->fee->owner_id);
        $this->vendor = $this->ambulantStall->vendor;
    }

    public function submit()
    {
        $this->fee->update([
            'receipt_no' => $this->receipt_no,
            'remarks' => $this->remarks,
            'status' => 'PAID',
        ]);
        notyf()->position('y', 'top')->success('Payment updated successfully!');
        $this->redirectRoute('main.fees.index', navigate :true);
    }

    public function render()
    {
        return view('livewire.main.stall.daily-collection-fee-update-payment');
    }
}

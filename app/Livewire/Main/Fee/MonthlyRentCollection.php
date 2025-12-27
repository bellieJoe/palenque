<?php

namespace App\Livewire\Main\Fee;

use App\Models\MonthlyRent;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class MonthlyRentCollection extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $monthFilter;

    public function rentPaymentPaid($monthly_rent_id)
    {
        $monthlyRent = MonthlyRent::find($monthly_rent_id);
        $amount = $monthlyRent->amount + $monthlyRent->penalty;
        MonthlyRent::find($monthly_rent_id)->update([
            'status' => 'PAID',
            'payment_date' => now(),
            'amount_paid' => $amount,
            'payment_method' => 'CASH'
        ]);
        $this->resetPage();
        notyf()->position('y', 'top')->success('Payment marked as paid!');
    }

    public function rentPaymentWaive($monthly_rent_id)
    {
        MonthlyRent::find($monthly_rent_id)->update([
            'status' => 'WAIVED',
        ]);
        $this->resetPage();
        notyf()->position('y', 'top')->success('Payment marked as waived!');
    }

    public function updatingMonthFilter()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->monthFilter = date('Y-m');
    }

    public function render()
    {
        $monthlyRents = MonthlyRent::query()
        ->with([
            'stallContract.stallOccupant.vendor', 'stallContract.stallOccupant.stall'
        ])
        ->where("municipal_market_id", auth()->user()->marketDesignation()->id)
        ->whereMonth("due_date", Carbon::parse($this->monthFilter)->format('m'))
        ->whereYear("due_date", Carbon::parse($this->monthFilter)->format('Y')) 
        ->paginate(20);
        return view('livewire.main.fee.monthly-rent-collection', [
            'monthlyRents' => $monthlyRents
        ]);
    }
}

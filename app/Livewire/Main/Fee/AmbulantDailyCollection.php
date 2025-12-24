<?php

namespace App\Livewire\Main\Fee;

use App\Models\AmbulantStall;
use App\Models\Fee;
use App\Models\FeeSetting;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

use function Flasher\Notyf\Prime\notyf;
use function Livewire\str;

class AmbulantDailyCollection extends Component
{
    use WithoutUrlPagination, WithPagination;
    public $dateFilter;
    #[Validate('required|numeric|min:0')]
    public $amount;
    public $activeFee;
    #[Validate('required|exists:ambulant_stalls,id')]
    public $stallId;
    #[Validate('required')]
    public $status;


    public function updatingDateFilter()
    {
        $this->resetPage();
    }

    public function openIssueTicketModal($stallId)
    {
        $this->stallId = $stallId;
        $this->dispatch('show-issue-ticket-modal');
    }

    public function mount()
    {
        $this->dateFilter = now()->format('Y-m-d');
        $this->activeFee = FeeSetting::where('municipal_market_id', auth()->user()->marketDesignation()->id)
            ->where('is_active', true)
            ->latest()
            ->first();
        $this->status = "PAID";
        $this->amount = $this->activeFee->rate;
    }

    public function storeTicket()
    {
        $this->validate([
            'stallId' => 'required|exists:ambulant_stalls,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required',
        ]);

        try {
            Fee::create([
                "no" => (new Fee())->generateNextTicketNo(),
                "ticket_no" => str_pad((new Fee())->generateNextTicketNo(), 5, '0', STR_PAD_LEFT),
                'municipal_market_id' => auth()->user()->marketDesignation()->id,
                'owner_id' => $this->stallId,
                'fee_type' => 'STALL',
                'amount' => $this->amount,
                'date_issued' => $this->dateFilter,
                'status' => $this->status,
                'date_paid' => $this->status == "PAID" ? now() : null,
            ]);
    
            // Reset form fields
            $this->stallId = null;
            $this->amount = $this->activeFee->rate;
            $this->status = "PAID";
    
            // Close modal (you might need to emit an event or use JavaScript for this)
            $this->dispatch('close-issue-ticket-modal');
            $this->resetPage();
    
            // Optionally, you can add a success message here
            notyf()->position('x', 'right')->position('y', 'top')->addSuccess('Ticket issued successfully.');
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            Log::info($th);
            notyf()->position('x', 'right')->position('y', 'top')->addError('An error occurred while issuing the ticket.');
        }

    }

    public function render()
    {
        $ambulantStalls = AmbulantStall::where("municipal_market_id", auth()->user()->marketDesignation()->id)
            ->orderBy('name', 'ASC')
            ->get();
        $collectedFees = Fee::whereDate('date_issued', $this->dateFilter ?? now())
            ->where('municipal_market_id', auth()->user()->marketDesignation()->id)
            ->where('fee_type', 'STALL')
            ->get();
        return view('livewire.main.fee.ambulant-daily-collection', [
            'ambulantStalls' => $ambulantStalls,
            'collectedFees' => $collectedFees
        ]);
    }
    
    
}

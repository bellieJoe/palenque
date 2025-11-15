<?php

namespace App\Livewire\Main\Stall;

use App\Models\AmbulantStall;
use App\Models\Fee;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use function Flasher\Notyf\Prime\notyf;

class DailyCollectionFeeCreate extends Component
{
    public $vendor;
    public $ambulantStall;
    #[Validate('required|numeric|min:0')]
    public $amount;
    #[Validate('required|in:PAID,UNPAID,WAIVED')]
    public $status;
    #[Validate('required_if:status,PAID|date|before:tomorrow')]
    public $date_paid;
    #[Validate('required_if:status,PAID')]
    public $receipt_no;
    public $remarks;

    public function mount($ambulant_stall_id)
    {
        $this->date_paid = now();
        $this->ambulantStall = AmbulantStall::find($ambulant_stall_id);
        $this->vendor = $this->ambulantStall->vendor;
    }

    public function storeDailyCollectionFee()
    {
        $this->validate();
        DB::transaction(function () {
            try {
                //code...
                $latestFee = Fee::query()->orderBy('no', 'desc')->first();
                $no = $latestFee ? $latestFee->no + 1 : 1;
                Fee::create([
                    'no' => $no,
                    "ticket_no" => now()->year . '-' . str_pad($no, 6, '0', STR_PAD_LEFT),
                    "owner_id" => $this->ambulantStall->id,
                    "municipal_market_id" => auth()->user()->marketDesignation()->id,
                    "fee_type" => "STALL",
                    "amount" => $this->amount,
                    "date_paid" => $this->status == "PAID" ? $this->date_paid : null,
                    "status" => $this->status,
                    "date_issued" => now(),
                    "receipt_no" => $this->status == "PAID" ? $this->receipt_no : null,
                    "remarks" => $this->remarks
                ]);
                notyf()->position('y', 'top')->success('Daily Collection fee issued successfully!');
                $this->redirectRoute('main.ambulant-stalls.index', navigate :true);
            } catch (\Throwable $th) {
                Log::info($th);
                notyf()->position('y', 'top')->error('Something went wrong while saving the ticket!');
                DB::rollBack();
            }
        });
    }

    public function render()
    {
        return view('livewire.main.stall.daily-collection-fee-create');
    }
}

<?php

namespace App\Livewire\Main\Vendor;

use App\Models\MonthlyRent;
use App\Models\Stall;
use App\Models\StallContract;
use App\Models\StallOccupant;
use App\Models\Vendor;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AssignVendor extends Component
{
    protected $listeners = [
        'assignStall' => 'showAssignStallModal'
    ];
    public $id;
    public $vendor = null;
    public $stalls;
    #[Validate('required')]
    public $stall;
    #[Validate('required|date')]
    public $start_date;
    #[Validate('required|date|after:start_date')]
    public $end_date;

    public function showAssignStallModal($id)
    {
        $this->id;
        $this->vendor = Vendor::find($id);
        $vendorStallsId = StallOccupant::where('vendor_id', $id)->pluck('stall_id')->toArray();
        $this->stalls = Stall::whereNotIn('id', $vendorStallsId)->get();
        $this->dispatch('show-assign-stall-modal');
    }

    public function assign()
    {
        $stallOccupant = StallOccupant::where('vendor_id', $this->vendor->id)->where('stall_id', $this->stall)->first();
        if($stallOccupant){
            notyf()->position('y', 'top')->error('Vendor is already assigned to this stall!');
            return;
        }
        DB::transaction(function () {
            $appSettings = auth()->user()->appSettings();
            $stall = Stall::find($this->stall);
            try {
                $occupant = StallOccupant::create(
                    [
                        'vendor_id' => $this->vendor->id,
                        'stall_id' => $this->stall,
                        'date_occupied' => now(),
                        'status' => 1
                    ]
                );
                $stallContract = StallContract::create([
                    'stall_occupant_id' => $occupant->id,
                    'from' => $this->start_date,
                    'to' => $this->end_date,
                    'stall_rate_id' => $stall->stall_rate_id
                ]);
                // Get the contract rate
                $stallRate = $stall->stallRate; 

                // Create monthly rents
                $start = Carbon::parse($this->start_date)->startOfMonth();
                $end = Carbon::parse($this->end_date)->endOfMonth();

                $months = $start->diffInMonths($end) + 1;

                $rents = [];

                for ($i = 0; $i < $months; $i++) {
                    $billDate = $start->copy()->addMonths($i)->format('Y-m-d');
                    $dueDate = Carbon::parse($billDate)->addDays($appSettings->rent_grace_period)->format('Y-m-d');
                    $rents[] = [
                        'stall_contract_id' => $stallContract->id,
                        'municipal_market_id' => $stall->municipal_market_id,
                        'bill_date' => $billDate,
                        'due_date' => $dueDate,
                        'amount' => $stallRate->rate,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                // Insert all months in one query
                MonthlyRent::insert($rents);
                $this->dispatch('hide-assign-stall-modal');
                $this->dispatch('refresh-vendor');
                notyf()->position('y', 'top')->success('Contract generated  successfully!');
            } catch (\Throwable $th) {
                Log::info($th);
                DB::rollBack();
                notyf()->position('y', 'top')->error('Something went wrong while generating the contract!');
            }
        });

    }

    public function mount()
    {
        $this->stalls = Stall::all();
    }

    public function render()
    {
        return view('livewire.main.vendor.assign-vendor');
    }
}

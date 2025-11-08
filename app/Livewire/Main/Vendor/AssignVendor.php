<?php

namespace App\Livewire\Main\Vendor;

use App\Models\Stall;
use App\Models\StallContract;
use App\Models\StallOccupant;
use App\Models\Vendor;
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
                StallContract::create([
                    'stall_occupant_id' => $occupant->id,
                    'from' => $this->start_date,
                    'to' => $this->end_date,
                    'stall_rate_id' => $stall->stall_rate_id
                ]);
                $this->dispatch('hide-assign-stall-modal');
                $this->dispatch('refresh-vendor');
                notyf()->position('y', 'top')->success('Contract generated  successfully!');
            } catch (\Throwable $th) {
                Log::info($th);
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

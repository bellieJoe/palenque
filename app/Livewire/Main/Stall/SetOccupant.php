<?php

namespace App\Livewire\Main\Stall;

use App\Models\Stall;
use App\Models\User;
use App\Models\Vendor;
use App\Notifications\VendorAssignedNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SetOccupant extends Component
{
    protected $listeners = ['setOccupant' => 'setOccupant'];
    public $vendors;
    public $stall;
    #[Validate('required|exists:vendors,id')]
    public $vendor;
    #[Validate('required|date|before_or_equal:now')]
    public $date_occupied;

    public function setOccupant($stall_id){
        $this->resetErrorBag();
        $this->reset(['vendor', 'date_occupied']);
        $this->stall = Stall::find($stall_id);
        $this->dispatch('show-set-stall-occupant-modal');
    }

    public function saveStallOccupant(){
        $this->validate();
        try {
            DB::transaction(function () {
                $this->stall->stallOccupants()->create([
                    "vendor_id" => $this->vendor,
                    "date_occupied" => $this->date_occupied,
                    "status" => true
                ]);
                $vendor = Vendor::find($this->vendor);
                Notification::send($vendor->user, new VendorAssignedNotification($this->stall));
                notyf()->position('y', 'top')->success('Stall Occupant set successfully!');
                $this->dispatch('hide-set-stall-occupant-modal');
                $this->dispatch('refresh-stalls');
            });
        } catch (\Throwable $th) {
            Log::error($th);
            notyf()->position('y', 'top')->error($th->getMessage());
        }
    }

    public function mount(){
        $this->vendors = Vendor::query()
        ->where("municipal_market_id", auth()->user()->marketDesignation()->id)
        ->whereDoesntHave('stallOccupants', function ($query) {
            $query->where('status', true);
        })
        ->get();
    }

    public function render()
    {
        return view('livewire.main.stall.set-occupant');
    }
}

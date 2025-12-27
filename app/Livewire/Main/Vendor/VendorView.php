<?php
namespace App\Livewire\Main\Vendor;

use App\Models\MonthlyRent;
use App\Models\Stall;
use App\Models\StallContract;
use App\Models\StallOccupant;
use App\Models\Vendor;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

use function Flasher\Notyf\Prime\notyf;

class VendorView extends Component
{
    protected $listeners = ['refresh-vendor' => 'refresh'];
    public $id;
    public $vendor;
    public $stalls;
    public $monthlyRents;

    public function mount($id){
        $this->id = $id;
        $this->vendor = Vendor::find($id);
        $this->stalls = StallOccupant::where('vendor_id', $id)->get();
        $this->monthlyRents = MonthlyRent::whereHas('stallContract', function ($query){
            $query->whereHas('stallOccupant', function ($query) {
                $query->where('vendor_id', $this->vendor->id);
            })
            ->whereNotIn('status', ['CANCELLED', 'TERMINATED']);
        })
        ->where('status', 'UNPAID')
        ->where("due_date", "<=", now()->addMonth(1))
        ->get();
    }

    public function refresh()
    {
        $this->vendor = Vendor::find($this->id);
        $this->stalls = StallOccupant::where('vendor_id', $this->id)->get();    
        $this->monthlyRents = MonthlyRent::whereHas('stallContract', function ($query){
            $query->whereHas('stallOccupant', function ($query) {
                $query->where('vendor_id', $this->vendor->id);
            })
            ->whereNotIn('status', ['CANCELLED', 'TERMINATED']);
        })
        ->where('status', 'UNPAID')
        ->where("due_date", "<=", now()->addMonth(1))
        ->get();
    }

    public function showAssignStallModal()
    {
        $this->dispatch('assignStall', $this->id);
    }

    public function deleteStall($id)
    {
        // validate if have contract
        DB::transaction(function () use ($id) {
            try {
                $stallOccupant = StallOccupant::find($id);
                $stallOccupant->delete();
                StallContract::where('stall_occupant_id', $id)->delete();
                $this->dispatch('refresh-vendor');
                MonthlyRent::whereHas('stallContract', function ($query) use ($stallOccupant) {
                    $query->where('stall_occupant_id', $stallOccupant->id);
                })->delete();
                $this->refresh();
                notyf()->position('y', 'top')->success('Stall deleted successfully!');
            } catch (\Throwable $th) {
                DB::rollBack();
                notyf()->position('y', 'top')->error('Failed to delete stall!');
            }
        });
    }

    public function terminateContract($stallOccupantId)
    {
        DB::transaction(function () use ($stallOccupantId) {
            try {
                $stallOccupant = StallOccupant::find($stallOccupantId);
                $stallOccupant->status = 0;
                $stallOccupant->save();
                StallContract::where([
                    'stall_occupant_id' => $stallOccupantId,
                ])->update([
                    'status' => 'TERMINATED'
                ]);
                notyf()->position('y', 'top')->success('Contract terminated successfully!');
                $this->refresh();
            } catch (\Throwable $th) {
                DB::rollBack();
                notyf()->position('y', 'top')->error('Something went wrong while terminating the contract!');
            }
        });
    }

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
        $this->refresh();
        notyf()->position('y', 'top')->success('Payment marked as paid!');
    }

    public function rentPaymentWaive($monthly_rent_id)
    {
        MonthlyRent::find($monthly_rent_id)->update([
            'status' => 'WAIVED',
        ]);
        $this->refresh();
        notyf()->position('y', 'top')->success('Payment marked as waived!');
    }
    
    public function render()
    {
        return view('livewire.main.vendor.vendor-view');
    }
}

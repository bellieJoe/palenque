<?php

namespace App\Livewire\Main\Vendor;

use App\Models\StallContract;
use App\Models\StallOccupant;
use App\Models\Vendor;
use Livewire\Component;

class VendorView extends Component
{
    protected $listeners = ['refresh-vendor' => 'refresh'];
    public $id;
    public $vendor;
    public $stalls;

    public function mount($id){
        $this->id = $id;
        $this->vendor = Vendor::find($id);
        $this->stalls = StallOccupant::where('vendor_id', $id)->get();
    }

    public function refresh()
    {
        $this->vendor = Vendor::find($this->id);
        $this->stalls = StallOccupant::where('vendor_id', $this->id)->get();    
    }

    public function showAssignStallModal()
    {
        $this->dispatch('assignStall', $this->id);
    }

    public function deleteStall($id)
    {
        // validate if have contract
        $stallOccupant = StallOccupant::find($id);
        $stallOccupant->delete();
        StallContract::where('stall_occupant_id', $id)->delete();
        $this->dispatch('refresh-vendor');
        notyf()->position('y', 'top')->success('Stall deleted successfully!');
    }
    
    public function render()
    {
        return view('livewire.main.vendor.vendor-view');
    }
}

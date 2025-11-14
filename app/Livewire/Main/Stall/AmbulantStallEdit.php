<?php

namespace App\Livewire\Main\Stall;

use App\Models\AmbulantStall;
use App\Models\Vendor;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AmbulantStallEdit extends Component
{
    public $vendors;
    public $ambulantStall;
    #[Validate('required|exists:vendors,id')]
    public $vendor;
    #[Validate('required|max:255')]
    public $name;

    public function mount($id)
    {
        $this->ambulantStall = AmbulantStall::find($id);
        $this->vendor = $this->ambulantStall->vendor_id;
        $this->name = $this->ambulantStall->name;
        $this->vendors = Vendor::query()
        ->where("municipal_market_id", auth()->user()->marketDesignation()->id)
        ->get();
    }

    public function updateAmbulantStall()
    {
        $this->ambulantStall->update([
            'name' => $this->name,
            'vendor_id' => $this->vendor,
        ]);
        notyf()->position('y', 'top')->success('Ambulant Stall updated successfully!');
        $this->redirectRoute('main.ambulant-stalls.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.main.stall.ambulant-stall-edit');
    }
}

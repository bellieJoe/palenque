<?php

namespace App\Livewire\Vendor\Stall;

use App\Models\AmbulantStall;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class AmbulantStallIndex extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $ambulantStalls = AmbulantStall::where('vendor_id', auth()->user()->vendor->id)->where('name', 'like', '%' . $this->search . '%')->paginate(15);
        return view('livewire.vendor.stall.ambulant-stall-index',[
            'ambulantStalls' => $ambulantStalls
        ]);
    }
}

<?php

namespace App\Livewire\Main\Stall;

use App\Models\AmbulantStall;
use App\Models\Vendor;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AmbulantStallCreate extends Component
{
    public $vendors;
    #[Validate('required|exists:vendors,id')]
    public $vendor;
    #[Validate('required|max:255')]
    public $name;

    public function storeAmbulantStall()
    {
        $latestStall = AmbulantStall::where('municipal_market_id', auth()->user()->marketDesignation()->id)->orderBy('order', 'desc')->first();
        $lastOrder = $latestStall ? $latestStall->order : 0;
        $order = $lastOrder + 1;
        AmbulantStall::create([
            'stall_no' => date('Y'). '-'.str_pad($order, 5, '0', STR_PAD_LEFT),
            'order' => $order,
            'name' => $this->name,
            'vendor_id' => $this->vendor,
            'municipal_market_id' => auth()->user()->marketDesignation()->id 
        ]);
        notyf()->position('y', 'top')->success('Ambulant Stall created successfully!');
        $this->redirectRoute('main.ambulant-stalls.index', navigate: true);
    }

    public function mount()
    {
        $this->vendors = Vendor::query()
        ->where("municipal_market_id", auth()->user()->marketDesignation()->id)
        ->get();
    }

    public function render()
    {
        return view('livewire.main.stall.ambulant-stall-create');
    }
}

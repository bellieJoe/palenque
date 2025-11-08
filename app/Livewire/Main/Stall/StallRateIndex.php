<?php

namespace App\Livewire\Main\Stall;

use App\Models\StallRate;
use Livewire\Component;

class StallRateIndex extends Component
{
    public $search = '';
    public function render()
    {
        $stalls = StallRate::query()->where('name', 'like', '%' . $this->search . '%')->where('municipal_market_id', auth()->user()->marketDesignation()->id)->paginate(10);
        return view('livewire.main.stall.stall-rate-index');
    }
}

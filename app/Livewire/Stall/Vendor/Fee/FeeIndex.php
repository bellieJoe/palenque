<?php

namespace App\Livewire\Stall\Vendor\Fee;

use App\Models\Fee;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class FeeIndex extends Component
{
    use WithPagination, WithoutUrlPagination;
    
    protected $listeners = [
        "refresh-fees"
    ];
    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function waive($id)
    {
        $fee = Fee::find($id);
        $fee->update([
            "status" => "WAIVED"
        ]);
        notyf()->position('y', 'top')->success('Ticket waived successfully!');
    }
    
    public function render()
    {
        $fees = Fee::query()
            ->whereHas("ambulantStall.vendor", fn($v) =>
                $v->where("name", "like", "%{$this->search}%")->where('id', auth()->user()->vendor->id)
            )
            ->where('fee_type', "stall")
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->whereHas("stallOccupant.vendor", fn($v) =>
                        $v->where("name", "like", "%{$this->search}%")
                    )
                    ->orWhereHas("supplier", fn($s) =>
                        $s->where("name", "like", "%{$this->search}%")
                    );
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('livewire.stall.vendor.fee.fee-index', [
            'fees' => $fees
        ]);
    }
}

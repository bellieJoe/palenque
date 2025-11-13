<?php

namespace App\Livewire\Main\Fee;

use App\Models\Fee;
use App\Models\StallOccupant;
use App\Models\Supplier;
use Livewire\Attributes\Validate;
use Livewire\Component;

class FeesCreate extends Component
{
    public $stallSearch = '';
    public $stallOptions = [];
    public $supplierSearch = '';
    public $supplierOptions = [];
    #[Validate('required|in:STALL,SUPPLIER')]
    public $type;
    #[Validate('required')]
    public $owner;
    #[Validate('required|numeric|min:0')]
    public $amount;
    #[Validate('nullable|max:255')]
    public $remarks;

    public function updatedType()
    {
        $this->owner = null;
    }

    public function updatedSupplierSearch($value)
    {
        $this->owner = null;
        if (trim($value) === '') {
            $this->supplierOptions = [];
            return;
        }

        $this->supplierOptions = Supplier::query()
            ->where('name', 'like', "%{$value}%")
            ->get()
            ->map(fn($item) => [
                'id' => $item->id,
                'name' => $item->name,
            ])
            ->toArray();
    }

    public function updatedStallSearch($value)
    {
        $this->owner = null;
        if (trim($value) === '') {
            $this->stallOptions = [];
            return;
        }

        $this->stallOptions = StallOccupant::query()
            ->with('stall')
            ->whereHas('stall', fn($q) => $q->where('name', 'like', "%{$value}%"))
            ->where('status', true)
            ->get()
            ->map(fn($item) => [
                'id' => $item->stall->id,
                'name' => $item->stall->name,
            ])
            ->toArray();
    }

    public function selectStallOccupant($id, $name)
    {
        $this->owner = $id;
        $this->stallSearch = $name;
        $this->stallOptions = [];
    }

    public function selectSupplier($id, $name)
    {
        $this->owner = $id;
        $this->supplierSearch = $name;
        $this->supplierOptions = [];
    }

    public function saveFee()
    {
        $this->validate();
        $latestFee = Fee::whereYear('date_issued', now()->year)->orderBy('no', 'desc')->first();
        $no = $latestFee ? $latestFee->no + 1 : 1;
        Fee::create([
            'no' => $no,
            'date_issued' => now(),
            'fee_type' => $this->type,
            'owner_id' => $this->owner,
            'amount' => $this->amount,
            'remarks' => $this->remarks,
            'municipal_market_id' => auth()->user()->marketDesignation()->id,
            'ticket_no' => now()->year . '-' . str_pad($no, 6, '0', STR_PAD_LEFT)
        ]);
        $this->redirectRoute('main.fees.index');
        notyf()->position('y', 'top')->success('Ticket/Fee created successfully!');
    }

    public function render()
    {
        return view('livewire.main.fee.fees-create');
    }
}

<?php

namespace App\Livewire\Main\Fee;

use App\Models\ItemFeeSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ItemFeeSettings extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[Validate('required|numeric|min:0|max:100')]
    public $tax_rate_percentage;

    public function mount()
    {
        
    }

    public function saveSettings()
    {
        $this->validate();

        DB::transaction(function () {
            try {
                ItemFeeSetting::where('municipal_market_id', auth()->user()->marketDesignation()->id)->update(['is_active' => false]);
                ItemFeeSetting::create([
                    'municipal_market_id' => auth()->user()->marketDesignation()->id,
                    'percentage' => $this->tax_rate_percentage,
                ]);
        
                $this->tax_rate_percentage = null;
                notyf()->position('x', 'right')->position('y', 'top')->addSuccess('Tax Rate settings saved successfully.');
            } catch (\Throwable $th) {
                //throw $th;
                DB::rollBack();
                Log::info($th);
                notyf()->position('x', 'right')->position('y', 'top')->addError('An error occurred while saving tax rate settings.');
            }
        });
    }


    
    public function render()
    {
        $fees = ItemFeeSetting::where('municipal_market_id', auth()->user()->marketDesignation()->id)->orderBy('created_at', 'desc')->paginate(15);
        return view('livewire.main.fee.item-fee-settings', [
            'fees' => $fees
        ]);
    }
}

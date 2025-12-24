<?php

namespace App\Livewire\Main\Fee;

use App\Models\FeeSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

use function Flasher\Notyf\Prime\notyf;

class FeeSettings extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[Validate('required|numeric|min:0')]
    public $daily_fee_amount;

    public function mount()
    {
        
    }

    public function saveSettings()
    {
        $this->validate();

        DB::transaction(function () {
            try {
                FeeSetting::where('municipal_market_id', auth()->user()->marketDesignation()->id)->update(['is_active' => false]);
                FeeSetting::create([
                    'municipal_market_id' => auth()->user()->marketDesignation()->id,
                    'rate' => $this->daily_fee_amount,
                ]);
        
                $this->daily_fee_amount = null;
                notyf()->position('x', 'right')->position('y', 'top')->addSuccess('Fee settings saved successfully.');
            } catch (\Throwable $th) {
                //throw $th;
                DB::rollBack();
                Log::info($th);
                notyf()->position('x', 'right')->position('y', 'top')->addError('An error occurred while saving fee settings.');
                
            }
        });

    }

    public function render()
    {
        $fees = FeeSetting::where('municipal_market_id', auth()->user()->marketDesignation()->id)->orderBy('created_at', 'desc')->paginate(15);
        return view('livewire.main.fee.fee-settings', [
            'fees' => $fees,
        ]);
    }
}

<?php

namespace App\Livewire\Main\Goods;

use App\Models\Item;
use App\Models\PriceMonitoringRecord;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;

use function Flasher\Notyf\Prime\notyf;

class PriceMonitoringEdit extends Component
{
    public $item;
    public $units;

    #[Validate('required|numeric|min:0.01')]
    public $price;
    #[Validate('required|date')]
    public $date;
    #[Validate('required|exists:units,id')]
    public $unit;

    public function store()
    {
        $this->validate();
        DB::transaction(function () {
            try {
                //code...
                $price = PriceMonitoringRecord::where(
                    [
                        'item_id' => $this->item->id,
                        'unit_id' => $this->unit,
                        'date' => $this->date,
                        "municipal_market_id" => auth()->user()->marketDesignation()->id
                    ]
                )
                ->first();
                if($price){
                    notyf()->position('y', 'top')->warning('Price already exists for this date and unit!. Now Updating the price...');
                    $price->update([
                        'price' => $this->price
                    ]);
                }
                else {
                    
                    PriceMonitoringRecord::create([
                        'item_id' => $this->item->id,
                        'unit_id' => $this->unit,
                        'date' => $this->date,
                        'price' => $this->price,
                        "municipal_market_id" => auth()->user()->marketDesignation()->id,
                        "user_id" => auth()->user()->id
                    ]);
                }
                notyf()->position('y', 'top')->success('Price updated successfully!');
                $this->redirect(route('main.price-monitoring.index'), navigate: true);
            } catch (\Throwable $th) {
                //throw $th;
                Log::error($th);
                notyf()->position('y', 'top')->error('Something went wrong while updating the price');
                DB::rollBack();
            }
        });
    }

    public function mount($id)
    {
        $this->date = now()->format('Y-m-d');
        $this->item = Item::find($id);
        $this->units = Unit::where('municipal_market_id', auth()->user()->marketDesignation()->id)->get();
    }
    
    public function render()
    {
        return view('livewire.main.goods.price-monitoring-edit');
    }
}

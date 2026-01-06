<?php

namespace App\Livewire\Main\Goods;

use App\Models\Item;
use App\Models\ItemTaxRate;
use App\Models\Unit;
use Livewire\Attributes\Validate;
use Livewire\Component;

use function Flasher\Notyf\Prime\notyf;

class ItemTaxRateEdit extends Component
{
    public $item;
    public $rates;
    public $units;
    #[Validate('required|min:0')]
    public $rate;
    #[Validate('required|exists:units,id')]
    public $unit;

    public function showAddTaxModal(){
        $this->dispatch('show-add-tax-modal');
    }

    public function saveItemTaxRate()
    {
        $this->validate([
            'unit' => 'required|exists:units,id',
            'rate' => 'required|numeric|min:0',
        ]);

        $marketId = optional(auth()->user()->marketDesignation())->id;

        if (!$marketId) {
            notyf()->error('Market designation not found.');
            return;
        }

        ItemTaxRate::updateOrCreate(
            [
                'item_id' => $this->item->id,
                'unit_id' => $this->unit,
                'municipal_market_id' => $marketId,
            ],
            [
                'tax_rate' => $this->rate,
            ]
        );

        notyf()->success('Tax rate updated successfully');
        $this->dispatch('hide-add-tax-modal');
    }

    public function deleteRate($id){
        ItemTaxRate::find($id)->delete();
        notyf()->success('Tax rate deleted successfully!');
    }


    public function mount($id){
        $this->item = Item::find($id);
        $this->units = Unit::where('municipal_market_id', auth()->user()->marketDesignation()->id)->get();
    }

    public function render()
    {
        $this->rates = ItemTaxRate::where('item_id', $this->item->id)->get();
        return view('livewire.main.goods.item-tax-rate-edit');
    }
}

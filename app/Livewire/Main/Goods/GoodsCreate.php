<?php

namespace App\Livewire\Main\Goods;

use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\Unit;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;

use function Flasher\Notyf\Prime\notyf;

class GoodsCreate extends Component
{
    public $units;
    public $categories;
    #[Validate('required|max:255')]
    public $name;
    #[Validate('required|exists:item_categories,id')]
    public $category;
    #[Validate('required')]
    public $type;
    #[Validate('required|exists:units,id')]
    public $defaultUnit;
    // #[Validate('required|numeric|min:0|max:100')]
    // public $taxPercentage;

    public function showCreateGoodsModal()
    {
        $this->reset(['name', 'category']);
        $this->dispatch('show-create-goods-modal');
    }

    public function saveItem()
    {
        $this->validate();
        try {
            Item::create([
                "name" => $this->name,
                "item_category_id" => $this->category,
                "municipal_market_id" => auth()->user()->marketDesignation()->id,
                "type" => $this->type,
                "default_unit_id" => $this->defaultUnit,
                // "tax_percentage" => $this->taxPercentage
            ]);
            notyf()->position('y', 'top')->success('Item created successfully!');
            $this->dispatch('hide-create-goods-modal');
            $this->dispatch('refresh-goods');
            return;
        } catch (\Throwable $th) {
            Log::error('Error creating item: ' . $th->getMessage());
            notyf()->position('y', 'top')->error('An error occurred while creating the item.');
        }
        
    }

    public function mount(){
        $this->categories = ItemCategory::where("municipal_market_id", auth()->user()->marketDesignation()->id)->get();
        $this->units = Unit::where("municipal_market_id", auth()->user()->marketDesignation()->id)->get();
    }
    
    public function render()
    {
        return view('livewire.main.goods.goods-create');
    }
}

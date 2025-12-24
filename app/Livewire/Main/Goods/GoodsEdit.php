<?php

namespace App\Livewire\Main\Goods;

use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\Unit;
use Livewire\Attributes\Validate;
use Livewire\Component;

class GoodsEdit extends Component
{
    protected $listeners = [
        'editItem' => 'editItem'
    ];
    public $units;
    #[Validate('required|min:3|max:255')]
    public $name;
    #[Validate('required|exists:item_categories,id')]
    public $category;
    #[Validate('required')]
    public $type;
    #[Validate('required|exists:units,id')]
    public $defaultUnit;
    public $item;

    public function editItem($id){
        $this->item = Item::find($id);
        $this->name = $this->item->name;
        $this->category = $this->item->item_category_id;
        $this->type = $this->item->type;
        $this->defaultUnit = $this->item->default_unit_id;
        $this->dispatch('show-edit-goods-modal');
    }

    public function updateItem(){
        $this->validate();
        $this->item->name = $this->name;
        $this->item->item_category_id = $this->category;
        $this->item->type = $this->type;
        $this->item->default_unit_id = $this->defaultUnit;
        $this->item->save();
        notyf()->position('y', 'top')->success('Item updated successfully!');
        $this->dispatch('hide-edit-goods-modal');
        $this->dispatch('refresh-goods');
    }

    public function render()
    {
        $categories = ItemCategory::where('municipal_market_id', auth()->user()->marketDesignation()->id)->get();
        $this->units = Unit::where("municipal_market_id", auth()->user()->marketDesignation()->id)->get();
        return view('livewire.main.goods.goods-edit', [
            'categories' => $categories
        ]);
    }
}

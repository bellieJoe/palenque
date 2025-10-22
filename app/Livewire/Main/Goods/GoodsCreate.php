<?php

namespace App\Livewire\Main\Goods;

use App\Models\Item;
use App\Models\ItemCategory;
use Livewire\Attributes\Validate;
use Livewire\Component;

class GoodsCreate extends Component
{
    public $categories;
    #[Validate('required|max:255')]
    public $name;
    #[Validate('required|exists:item_categories,id')]
    public $category;

    public function showCreateGoodsModal()
    {
        $this->dispatch('show-create-goods-modal');
    }

    public function saveItem()
    {
        $this->validate();
        Item::create([
            "name" => $this->name,
            "item_category_id" => $this->category,
            "municipal_market_id" => auth()->user()->marketDesignation()->id
        ]);
        notyf()->position('y', 'top')->success('Item created successfully!');
        $this->dispatch('hide-create-goods-modal');
        $this->dispatch('refresh-goods');
        return;
    }

    public function mount(){
        $this->categories = ItemCategory::all();
    }
    
    public function render()
    {
        return view('livewire.main.goods.goods-create');
    }
}

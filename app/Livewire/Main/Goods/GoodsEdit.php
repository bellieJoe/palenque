<?php

namespace App\Livewire\Main\Goods;

use App\Models\Item;
use App\Models\ItemCategory;
use Livewire\Attributes\Validate;
use Livewire\Component;

class GoodsEdit extends Component
{
    protected $listeners = [
        'editItem' => 'editItem'
    ];
    #[Validate('required|min:3|max:255')]
    public $name;
    #[Validate('required|exists:item_categories,id')]
    public $category;
    public $item;

    public function editItem($id){
        $this->item = Item::find($id);
        $this->name = $this->item->name;
        $this->category = $this->item->item_category_id;
        $this->dispatch('show-edit-goods-modal');
    }

    public function updateItem(){
        $this->validate();
        $this->item->name = $this->name;
        $this->item->item_category_id = $this->category;
        $this->item->save();
        notyf()->position('y', 'top')->success('Item updated successfully!');
        $this->dispatch('hide-edit-goods-modal');
        $this->dispatch('refresh-goods');
    }

    public function render()
    {
        $categories = ItemCategory::where('municipal_market_id', auth()->user()->marketDesignation()->id)->get();
        return view('livewire.main.goods.goods-edit', [
            'categories' => $categories
        ]);
    }
}

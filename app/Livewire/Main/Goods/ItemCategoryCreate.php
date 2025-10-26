<?php

namespace App\Livewire\Main\Goods;

use App\Models\ItemCategory;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ItemCategoryCreate extends Component
{
    #[Validate('required|max:255')]
    public $name;

    public function showCreateItemCategoryModal()
    {
        $this->reset(['name']);
        $this->dispatch('show-create-item-category-modal');
    }

    public function saveItemCategory()
    {
        $this->validate();
        ItemCategory::create([
            "name" => $this->name,
            "municipal_market_id" => auth()->user()->marketDesignation()->id
        ]);
        notyf()->position('y', 'top')->success('Item Category created successfully!');
        $this->dispatch('hide-create-item-category-modal');
        $this->dispatch('refresh-item-categories');
        return;
    }
    
    public function render()
    {
        return view('livewire.main.goods.item-category-create');
    }
}

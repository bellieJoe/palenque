<?php

namespace App\Livewire\Main\Goods;

use App\Models\ItemCategory;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ItemCategoryEdit extends Component
{
    protected $listeners = [
        'editCategory' => 'editCategory'
    ];

    public $category;
    #[Validate('required|max:255')]
    public $name;
    #[Validate('required')]
    public $is_fish;

    public function editCategory($id)
    {
        $this->category = ItemCategory::find($id);
        $this->name = $this->category->name;
        $this->is_fish = $this->category->is_fish;
        $this->dispatch('show-edit-item-category-modal');
    }

    public function updateCategory()
    {
        $this->validate();
        ItemCategory::where('id', $this->category->id)->update([
            "name" => $this->name,
            "is_fish" => $this->is_fish
        ]);
        notyf()->position('y', 'top')->success('Category updated successfully!');
        $this->dispatch('hide-edit-item-category-modal');
        $this->dispatch('refresh-item-categories');
    }

    public function render()
    {
        return view('livewire.main.goods.item-category-edit');
    }
}

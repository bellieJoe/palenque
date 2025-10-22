<?php

namespace App\Livewire\Main\Goods;

use App\Models\Item;
use App\Models\ItemCategory;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ItemCategoryIndex extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $listeners = [
        'refresh-item-categories'
    ];
    
    public $search;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function deleteCategory($id)
    {
        $category = ItemCategory::find($id);
        if(Item::where('item_category_id', $category->id)->count() > 0){
            notyf()->position('y', 'top')->error('Item Category is in use and cannot be deleted!');
            return;
        }
        $category->delete();
        notyf()->position('y', 'top')->success('Item Category deleted successfully!');
    }

    public function editCategory($id)
    {
        $this->dispatch('editCategory', $id);
    }

    public function render()
    {
        $categories = ItemCategory::where('municipal_market_id', auth()->user()->marketDesignation()->id)
        ->where('name', 'like', '%' . $this->search . '%')
        ->paginate(10);
        return view('livewire.main.goods.item-category-index', [
            'categories' => $categories
        ]);
    }


}

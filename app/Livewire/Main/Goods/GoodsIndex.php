<?php

namespace App\Livewire\Main\Goods;

use App\Models\Item;
use Livewire\Component;

class GoodsIndex extends Component
{
    protected $listeners = ['refresh-goods'];

    public $search;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function editItem($id){
        $this->dispatch('editItem', $id);
    }

    public function deleteItem($id){
        $item = Item::find($id);
        $item->delete();
        notyf()->position('y', 'top')->success('Item deleted successfully!');
    }

    public function render()
    {
        $items = Item::where('municipal_market_id', auth()->user()->marketDesignation()->id)
        ->where('name', 'like', '%' . $this->search . '%')
        ->paginate(10);
        return view('livewire.main.goods.goods-index', [
            'items' => $items
        ]);
    }
}

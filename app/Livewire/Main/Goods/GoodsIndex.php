<?php

namespace App\Livewire\Main\Goods;

use App\Models\Item;
use App\Models\PriceMonitoringRecord;
use Illuminate\Support\Facades\Gate;
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
        if(PriceMonitoringRecord::where('item_id', $item->id)->count() > 0){
            notyf()->position('y', 'top')->error('Cannot delete item with associated price monitoring records.');
            return;
        }
        $item->delete();
        notyf()->position('y', 'top')->success('Item deleted successfully!');
    }

    public function render()
    {
        Gate::authorize('viewAny', Item::class);
        $items = Item::where('municipal_market_id', auth()->user()->marketDesignation()->id)
        ->where('name', 'like', '%' . $this->search . '%')
        ->paginate(10);
        return view('livewire.main.goods.goods-index', [
            'items' => $items
        ]);
    }
}

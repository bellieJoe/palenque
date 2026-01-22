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
        // if(PriceMonitoringRecord::where('item_id', $item->id)->count() > 0){
        //     notyf()->position('y', 'top')->error('Cannot delete item with associated price monitoring records.');
        //     return;
        // }
        $item->update([
            "restore_date" =>  now()->addDays(60)->format("Y-m-d")
        ]);
        $item->delete();
        notyf()->position('y', 'top')->success('Item deleted successfully!');
    }

    public function restoreItem($id)
    {
        $item = Item::withTrashed()->find($id);
        $item->withTrashed()->update([
            "restore_date" => null
        ]);
        $item->restore();
        notyf()->position('y', 'top')->success('Item restored successfully!');
    }

    public function render()
    {
        Gate::authorize('viewAny', Item::class);
        $items = Item::query()
        ->withTrashed()
        ->where(function ($q) {
            $q->whereNull('deleted_at') // active records (ignore restore_date)
            ->orWhere(function ($q) {
                $q->whereNotNull('deleted_at') // deleted records
                    ->whereDate('restore_date', '>', today());
            });
        })
        ->where('municipal_market_id', auth()->user()->marketDesignation()->id)
        ->where('name', 'like', '%' . $this->search . '%')
        ->orderBy('restore_date', 'asc')
        ->paginate(10);
        return view('livewire.main.goods.goods-index', [
            'items' => $items
        ]);
    }

    
}

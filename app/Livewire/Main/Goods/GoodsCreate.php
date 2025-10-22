<?php

namespace App\Livewire\Main\Goods;

use App\Models\Item;
use Livewire\Attributes\Validate;
use Livewire\Component;

class GoodsCreate extends Component
{
    #[Validate('required|max:255')]
    public $name;

    public function showCreateGoodsModal()
    {
        $this->dispatch('show-create-goods-modal');
    }

    public function saveItem()
    {
        $this->validate();
        Item::create([
            "name" => $this->name,
            "municipal_market_id" => auth()->user()->marketDesignation()->id
        ]);
        notyf()->position('y', 'top')->success('Stall created successfully!');
        $this->dispatch('hide-create-stall-modal');
        $this->dispatch('refresh-stalls');
        return;
    }
    
    public function render()
    {
        return view('livewire.main.goods.goods-create');
    }
}

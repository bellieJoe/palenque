<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\MunicipalMarket;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PublicMarketEdit extends Component
{
    protected $listeners = ['editPublicMarket' => 'onShowEditPublicMarket'];
    public $market;
    #[Validate('required|max:255')]
    public $name;
    #[Validate('required|max:255')]
    public $address;

    public function onShowEditPublicMarket($id) {
        $market = MunicipalMarket::find($id);
        $this->dispatch('show-edit-public-market-modal');
        $this->market = $market;
        $this->name = $market->name;
        $this->address = $market->address;
    }

    public function updateMarket() {
        Gate::authorize('update', $this->market);
        $this->validate();
        $this->market->name = $this->name;
        $this->market->address = $this->address;
        $this->market->save();
        $this->dispatch('hide-edit-public-market-modal');
        $this->dispatch('refresh-public-markets');
        notyf()->position('y', 'top')->success('Public Market updated successfully!');  
        $this->reset(['name', 'address']);
    }

    public function render()
    {
        return view('livewire.admin.maintenance.public-market-edit');
    }
}

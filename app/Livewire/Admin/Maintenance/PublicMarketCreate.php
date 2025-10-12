<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\MunicipalMarket;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PublicMarketCreate extends Component
{
    #[Validate('required|max:255')]
    public $name = '';
    #[Validate('required|max:255')]
    public $address = '';

    public function showCreatePublicMarketModal(){
        $this->dispatch('show-create-public-market-modal');
        $this->reset(['name', 'address']);
        $this->resetErrorBag();
    }

    public function hideCreatePublicMarketModal(){
        $this->dispatch('hide-create-public-market-modal');
        $this->reset(['name', 'email']);
        $this->resetErrorBag();
    }

    public function savePublicMarket(){
        $this->validate();
        DB::transaction(function () {
            MunicipalMarket::create([
                "name" => $this->name,
                "address" => $this->address
            ]);
            notyf()->position('y', 'top')->success('Public Market added successfully!');
            $this->dispatch('hide-create-public-market-modal');
            $this->dispatch('refresh-public-markets');
            return;
        });
    }

    public function render()
    {
        return view('livewire.admin.maintenance.public-market-create');
    }
}

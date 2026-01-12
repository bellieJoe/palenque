<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\MunicipalMarket;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class PublicMarketIndex extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refresh-public-markets'];

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function editPublicMarket($id)
    {
        $this->dispatch('editPublicMarket', $id);
    }

    public function deletePublicMarket($id)
    {
        MunicipalMarket::find($id)->softDelete();
        notyf()->position('y', 'top')->success('Public Market deleted successfully!');
    }

    public function render()
    {
        Gate::authorize('viewAny', MunicipalMarket::class);
        $publicMarkets = MunicipalMarket::query()->where('name', 'like', '%' . $this->search . '%')->paginate(10);
        return view('livewire.admin.maintenance.public-market-index', [
            'publicMarkets' => $publicMarkets
        ]);
    }
}

<?php

namespace App\Livewire\Main\Goods;

use App\Models\DeliveryItem;
use App\Models\Item;
use App\Models\ItemTaxRate;
use App\Models\Unit;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class UnitIndex extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $listeners = [
        "refresh-units"
    ];
    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function deleteUnit($id)
    {
        $unit = Unit::find($id);
        if(
            DeliveryItem::where("unit_id", $unit->id)->count() > 0
            || Item::where("default_unit_id", $unit->id)->count() > 0
            || ItemTaxRate::where("unit_id", $unit->id)->count() > 0
            // add other validations or relation
        )
        {
            notyf()->position('y', 'top')->warning('Unit is in use and cannot be deleted!');
            return;
        }
        $unit->update([
            "restore_date" => now()->addDays(60)->format("Y-m-d")
        ]);
        $unit->delete();
        notyf()->position('y', 'top')->success('Unit deleted successfully!');
    }

    public function render()
    {
        Gate::authorize('viewAny', Unit::class);
        $units = Unit::query()
        ->withTrashed()
        ->where(function ($q) {
            $q->whereNull('deleted_at') // active records (ignore restore_date)
            ->orWhere(function ($q) {
                $q->whereNotNull('deleted_at') // deleted records
                    ->whereDate('restore_date', '>', today());
            });
        })
        ->where("name", "like", "%{$this->search}%")
        ->where("municipal_market_id", auth()->user()->marketDesignation()->id)
        ->orderBy("restore_date", "asc")
        ->paginate(10);
        return view('livewire.main.goods.unit-index', [
            'units' => $units
        ]);
    }

    public function restoreUnit($id)
    {
        $unit = Unit::withTrashed()->find($id);
        $unit->update([
            "restore_date" => null
        ]);
        $unit->restore();
        notyf()->position('y', 'top')->success('Unit restored successfully!');
    }
}

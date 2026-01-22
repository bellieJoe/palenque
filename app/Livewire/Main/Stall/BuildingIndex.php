<?php

namespace App\Livewire\Main\Stall;

use App\Models\Building;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

use function Flasher\Notyf\Prime\notyf;

class BuildingIndex extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $buildings = Building::query()
        ->withTrashed()
        ->where(function ($q) {
            $q->whereNull('deleted_at') // active records (ignore restore_date)
            ->orWhere(function ($q) {
                $q->whereNotNull('deleted_at') // deleted records
                    ->whereDate('restore_date', '>', today());
            });
        })
        ->where("municipal_market_id", auth()->user()->marketDesignation()->id)->where("name", "like", "%{$this->search}%")
        ->with("stalls")
        ->paginate(20);
        return view('livewire.main.stall.building-index',
        [
            "buildings" => $buildings
        ]);
    }

    public function deleteBuilding($id)
    {
        $building = Building::find($id);
        $building->update([
            "restore_date" => now()->addDays(60)->format("Y-m-d")
        ]);
        $building->delete();
        notyf()->position('y', 'top')->success('Building deleted successfully!');
    }

    public function restoreBuilding($id)
    {
        $building = Building::withTrashed()->find($id);
        $building->update([
            "restore_date" => null
        ]);
        $building->restore();
        notyf()->position('y', 'top')->success('Building restored successfully!');
    }
}

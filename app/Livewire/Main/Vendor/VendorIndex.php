<?php

namespace App\Livewire\Main\Vendor;

use App\Models\AmbulantStall;
use App\Models\Role;
use App\Models\StallOccupant;
use App\Models\Vendor;
use App\Models\Violation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class VendorIndex extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $listeners = [
        "refresh-vendors"
    ];

    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function editVendor($id){
        $this->dispatch("editVendor", $id);
    }

    public function deleteVendor($id){
        try {
            DB::transaction(function () use ($id) {
                $vendor = Vendor::with('user')->findOrFail($id);
                if(
                    StallOccupant::where("vendor_id", $vendor->id)->exists()
                    || AmbulantStall::where("vendor_id", $vendor->id)->exists()
                    || Violation::where("vendor_id", $vendor->id)->exists()
                ){
                    notyf()->position('y', 'top')->error('Vendor already has associated data!');
                    return;
                }
                $user = $vendor->user;
                // Delete related roles first
                // Role::where("user_id", $user->id)->delete();
                // Delete user and vendor
                $vendor->update([
                    "restore_date" => now()->addDays(60)->format('Y-m-d')
                ]);
                $user->delete();
                $vendor->delete();
                notyf()->position('y', 'top')->success('Vendor deleted successfully!');
            });
        } catch (\Throwable $th) {
            Log::error($th);
            notyf()->position('y', 'top')->error('Failed to delete vendor!');
        }
    }

    public function restoreVendor($id){
        try {
            DB::transaction(function () use ($id) {
                $vendor = Vendor::withTrashed()->with('user')->findOrFail($id);
                $vendor->update([
                    "restore_date" => null
                ]);
                $vendor->restore();
                $vendor->user()->restore();
                notyf()->position('y', 'top')->success('Vendor restored successfully!');
            });
        } catch (\Throwable $th) {
            Log::error($th);
            notyf()->position('y', 'top')->error('Failed to restore vendor!');
        }
    }

    public function render()
    {
        Gate::authorize('viewAny', Vendor::class);
        $vendors = Vendor::query()
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
        ->with("user", function($q){
            $q->withTrashed();
        })
        ->orderBy('restore_date', 'asc')
        ->paginate(10);
        return view('livewire.main.vendor.vendor-index', ["vendors" => $vendors]);
    }
}

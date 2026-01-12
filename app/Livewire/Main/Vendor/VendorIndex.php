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
                Role::where("user_id", $user->id)->delete();
                // Delete user and vendor
                $user->delete();
                $vendor->delete();
                notyf()->position('y', 'top')->success('Vendor deleted successfully!');
            });
        } catch (\Throwable $th) {
            Log::error($th);
            notyf()->position('y', 'top')->error('Failed to delete vendor!');
        }
    }

    public function render()
    {
        Gate::authorize('viewAny', Vendor::class);
        $vendors = Vendor::query()
        ->where("name", "like", "%{$this->search}%")
        ->where("municipal_market_id", auth()->user()->marketDesignation()->id)
        ->with("user")
        ->paginate(10);
        return view('livewire.main.vendor.vendor-index', ["vendors" => $vendors]);
    }
}

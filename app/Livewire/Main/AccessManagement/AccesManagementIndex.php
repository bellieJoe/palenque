<?php

namespace App\Livewire\Main\AccessManagement;

use App\Models\Role;
use App\Models\RolePreset;
use App\Models\RoleType;
use Livewire\Attributes\Validate;
use Livewire\Component;

use function Flasher\Notyf\Prime\notyf;

class AccesManagementIndex extends Component
{
    #[Validate('required|exists:role_types,id')]
    public $roleType;
    public $roleTypes;
    public $rolePreset;
    #[Validate('array|min:1')]
    public $permissions = [
        'data_entry_wet_dry_goods_deliveries' => false,
        'data_entry_wet_dry_goods_price_monitoring' => false,
        'data_entry_violation_violations' => false,
        'data_entry_fees_collection_ambulants' => false,
        'data_entry_fees_collection_monthly_rents' => false,

        'maintenance_suppliers' => false,
        'maintenance_vendors' => false,
        'maintenance_stall_management_ambulants' => false,
        'maintenance_stall_management_stalls' => false,
        'maintenance_stall_management_stall_rates' => false,
        'maintenance_wet_dry_goods_items' => false,
        'maintenance_wet_dry_goods_categories' => false,
        'maintenance_wet_dry_goods_units' => false,
        'maintenance_violation_types' => false,
        'maintenance_fees_ambulants' => false,
        'maintenance_fees_tax_rate' => false,

        'reports' => false,
        'app_settings' => false,
    ];

    public function save()
    {
        $this->validate();

        // Ensure at least one permission is selected
        if (!collect($this->permissions)->contains(true)) {
            $this->addError('permissions', 'Select at least one permission.');
            return;
        }

        $marketId = optional(auth()->user()->marketDesignation())->id;

        if (!$marketId) {
            $this->addError('roleType', 'Market designation not found.');
            return;
        }

        // Update or create the role preset
        RolePreset::updateOrCreate(
            [
                'role_type_id' => $this->roleType,
                'municipal_market_id' => $marketId,
            ],
            $this->permissions
        );

        // UX feedback
        notyf()->position('y', 'top')->success('Permissions saved successfully!');
    }


    public function updatingRoleType($value)
    {
        $this->rolePreset = RolePreset::where('role_type_id', $value)
            ->where('municipal_market_id', auth()->user()->marketDesignation()->id)
            ->first();

        if ($this->rolePreset) {
            $this->permissions = collect($this->permissions)
                ->mapWithKeys(function ($_, $key) {
                    return [$key => (bool) $this->rolePreset->{$key}];
                })
                ->toArray();
        } else {
            // Reset permissions if no preset exists
            $this->resetPermissions();
        }
    }

    private function resetPermissions()
    {
        foreach ($this->permissions as $key => $value) {
            $this->permissions[$key] = false;
        }
    }

    public function mount(){
        $this->roleTypes = RoleType::whereIn("id", [2, 4, 5])->get();
    }

    public function render()
    {
        return view('livewire.main.access-management.acces-management-index');
    }
}

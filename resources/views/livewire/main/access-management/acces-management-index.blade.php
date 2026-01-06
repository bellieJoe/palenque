<div>
    <x-page-header title="Access Management" />
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="">
                        <label for="">Select Role</label>
                        <select name="" id="" class="form-control" wire:model.live.debounce.300ms="roleType">
                            <option value="">Select Role</option>
                            @foreach ($roleTypes as $roleType)
                                <option value="{{ $roleType->id }}">{{ $roleType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            @if (!empty($permissions))
                <div class="p-2 mt-3">
                    <form wire:submit.prevent="save">
                        <h5 class="mb-3">Data Entry</h5>
                        <div class="row">
                            <div class="col-md-6" >
                                @foreach ([
                                    'data_entry_wet_dry_goods_deliveries' => 'Wet & Dry Goods Deliveries',
                                    'data_entry_wet_dry_goods_price_monitoring' => 'Price Monitoring',
                                    'data_entry_violation_violations' => 'Violations',
                                    'data_entry_fees_collection_ambulants' => 'Fees Collection (Ambulants)',
                                    'data_entry_fees_collection_monthly_rents' => 'Fees Collection (Monthly Rents)',
                                ] as $key => $label)
                                    <div class="form-check mb-2">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            wire:model.defer="permissions.{{ $key }}"
                                            id="{{ $key }}"
                                        >
                                        <label class="form-check-label" for="{{ $key }}">
                                            {{ $label }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <hr>

                        <h5 class="mb-3">Maintenance</h5>
                        <div class="row">
                            <div class="col-md-6">
                                @foreach ([
                                    'maintenance_suppliers' => 'Suppliers',
                                    'maintenance_vendors' => 'Vendors',
                                    'maintenance_stall_management_ambulants' => 'Stall Management – Ambulants',
                                    'maintenance_stall_management_stalls' => 'Stalls',
                                    'maintenance_stall_management_stall_rates' => 'Stall Rates',
                                    'maintenance_wet_dry_goods_items' => 'Items',
                                    'maintenance_wet_dry_goods_categories' => 'Categories',
                                    'maintenance_wet_dry_goods_units' => 'Units',
                                    'maintenance_violation_types' => 'Violation Types',
                                    'maintenance_fees_ambulants' => 'Fees – Ambulants',
                                    'maintenance_fees_tax_rate' => 'Tax Rates',
                                ] as $key => $label)
                                    <div class="form-check mb-2">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            wire:model.defer="permissions.{{ $key }}"
                                            id="{{ $key }}"
                                        >
                                        <label class="form-check-label" for="{{ $key }}">
                                            {{ $label }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <hr>

                        <h5 class="mb-3">Other</h5>
                        <div class="form-check mb-2">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                wire:model.defer="permissions.reports"
                                id="reports"
                            >
                            <label class="form-check-label" for="reports">
                                Reports
                            </label>
                        </div>

                        <div class="form-check mb-4">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                wire:model.defer="permissions.app_settings"
                                id="app_settings"
                            >
                            <label class="form-check-label" for="app_settings">
                                App Settings
                            </label>
                        </div>

                        <button class="btn btn-primary">
                            Save Permissions
                        </button>
                    </form>
                </div>
            @endif
            @if (empty($permissions))
                <div class="p-3 bg-light mt-3">
                    <p class="text-muted">Please select a role</p>
                </div>
            @endif
        </div>
    </div>
</div>

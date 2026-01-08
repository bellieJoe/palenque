<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" >
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a href="{{ route('dashboard') }}"  class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" wire:navigate>
                        <i class="mdi mdi-view-dashboard"></i>
                        <span class="hide-menu"> Dashboard </span>
                    </a>
                </li>
                @if (auth()->user()->isMarketAdmin())
                <li class="sidebar-item">
                    <a href="{{ route('main.users.index') }}"  class="sidebar-link {{ request()->routeIs('main.users.index') ? 'active' : '' }}" wire:navigate>
                        <i class="fa-solid fa-users"></i>
                        <span class="hide-menu"> Users </span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('main.access-management.index') }}"  class="sidebar-link {{ request()->routeIs('main.access-management.index') ? 'active' : '' }}" wire:navigate>
                        <i class="fa-solid fa-user-shield"></i>
                        <span class="hide-menu"> Access Management </span>
                    </a>
                </li>
                @endif

                {{-- SUPER ADMIN ONLY --}}
                @if (auth()->user()->isAdmin())
                    <li class="sidebar-item">
                        <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" wire:navigate>
                            <i class="fas fa-users"></i>
                            <span class="hide-menu"> Users </span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('admin.municipal-markets.index') }}" class="sidebar-link {{ request()->routeIs('admin.municipal-markets.*') ? 'active' : '' }}" wire:navigate>
                            <i class="mdi mdi-domain"></i>
                            <span class="hide-menu"> Public Markets </span>
                        </a>
                    </li>
                @endif

                {{-- MAIN --}}
                @if (auth()->user()->isMarketSupervisor() || auth()->user()->isAdminAide() || auth()->user()->isMarketSpecialist() || auth()->user()->isMarketInspector())
                    @if (auth()->user()->access->data_entry_wet_dry_goods_deliveries || auth()->user()->access->data_entry_wet_dry_goods_price_monitoring || auth()->user()->access->data_entry_violation_violations || auth()->user()->access->data_entry_fees_collection_ambulants || auth()->user()->access->data_entry_fees_collection_monthly_rents)
                        <li class="nav-small-cap">
                            <i class="mdi mdi-dots-horizontal"></i>
                            <span class="hide-menu">Data Entry</span>
                        </li>
                        @if (auth()->user()->access->data_entry_wet_dry_goods_deliveries || auth()->user()->access->data_entry_wet_dry_goods_price_monitoring)
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                    <i class="mdi mdi-food-variant" aria-hidden="true"></i>
                                    <span class="hide-menu"> Wet & Dry Goods </span>
                                </a>
                                <ul aria-expanded="false" class="collapse first-level">
                                    @if (auth()->user()->access->data_entry_wet_dry_goods_deliveries)
                                    <li class="sidebar-item">
                                        <a href="{{ route('main.deliveries.index') }}" class="sidebar-link {{ request()->routeIs('main.deliveries.*') ? 'active' : '' }}" wire:navigate>
                                            <i class="" aria-hidden="true"></i>
                                            <span class="hide-menu"> Deliveries </span>
                                        </a>    
                                    </li>
                                    @endif
                                    @if (auth()->user()->access->data_entry_wet_dry_goods_price_monitoring)
                                    <li class="sidebar-item">
                                        <a href="{{ route('main.price-monitoring.index') }}" class="sidebar-link {{ request()->routeIs('main.price-monitoring.*') ? 'active' : '' }}" wire:navigate>
                                            <i class=""></i>
                                            <span class="hide-menu"> Price Montoring </span>
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if (auth()->user()->access->data_entry_violation_violations)
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-account-alert" aria-hidden="true"></i>
                                <span class="hide-menu"> Violation Monitoring </span>
                            </a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                @if (auth()->user()->access->data_entry_violation_violations)
                                    <li class="sidebar-item">
                                        <a href="{{ route('main.violations.index') }}" class="sidebar-link {{ request()->routeIs('main.violations.*') ? 'active' : '' }}" wire:navigate>
                                            <i class="" aria-hidden="true"></i>
                                            <span class="hide-menu"> Violations </span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        @endif
                        @if(auth()->user()->access->data_entry_fees_collection_ambulants || auth()->user()->access->data_entry_fees_collection_monthly_rents)
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-ticket-percent" aria-hidden="true"></i>
                                <span class="hide-menu"> Fees Collection </span>
                            </a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                @if (auth()->user()->access->data_entry_fees_collection_ambulants)
                                <li class="sidebar-item">
                                    <a href="{{ route('main.fees.ambulants') }}" class="sidebar-link {{ request()->routeIs('main.fees.ambulants') ? 'active' : '' }}" wire:navigate>
                                        <i class="" aria-hidden="true"></i>
                                        <span class="hide-menu"> Ambulants</span>
                                    </a>
                                </li>  
                                @endif
                                @if (auth()->user()->access->data_entry_fees_collection_monthly_rents)
                                <li class="sidebar-item">
                                    <a href="{{ route('main.fees.monthlyRents') }}" class="sidebar-link {{ request()->routeIs('main.fees.monthlyRents') ? 'active' : '' }}" wire:navigate>
                                        <i class="" aria-hidden="true"></i>
                                        <span class="hide-menu"> Monthly Rents</span>
                                    </a>
                                </li>  
                                @endif
                            </ul>
                        </li>
                        @endif
                    @endif

                    @if (
                        auth()->user()->access->maintenance_suppliers ||
                        auth()->user()->access->maintenance_vendors ||
                        auth()->user()->access->maintenance_stall_management_ambulants ||
                        auth()->user()->access->maintenance_stall_management_stalls ||
                        auth()->user()->access->maintenance_stall_management_stall_rates ||
                        auth()->user()->access->maintenance_wet_dry_goods_items ||
                        auth()->user()->access->maintenance_wet_dry_goods_categories ||
                        auth()->user()->access->maintenance_wet_dry_goods_units ||
                        auth()->user()->access->maintenance_violation_types ||
                        auth()->user()->access->maintenance_fees_ambulants ||
                        auth()->user()->access->maintenance_fees_tax_rate
                    )
                        <li class="nav-small-cap">
                            <i class="mdi mdi-dots-horizontal"></i>
                            <span class="hide-menu">Maintenance</span>
                        </li>
                        @if (auth()->user()->access->maintenance_suppliers)
                        <li class="sidebar-item">
                            <a href="{{ route('main.suppliers.index') }}" class="sidebar-link {{ request()->routeIs('main.suppliers.*') ? 'active' : '' }}" wire:navigate>
                                <i class="mdi mdi-truck-delivery"></i>
                                <span class="hide-menu"> Suppliers </span>
                            </a>
                        </li>
                        @endif
                        @if(auth()->user()->access->maintenance_vendors)
                            <li class="sidebar-item">
                                <a href="{{ route('main.vendors.index') }}" class="sidebar-link {{ request()->routeIs('main.vendors.*') || request()->routeIs('main.vendors.view.*') ? 'active' : '' }}" wire:navigate>
                                    <i class="fa-solid fa-id-card-clip"></i>
                                    <span class="hide-menu"> Vendors </span>
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->access->maintenance_stall_management_ambulants ||
                        auth()->user()->access->maintenance_stall_management_stalls ||
                        auth()->user()->access->maintenance_stall_management_stall_rates)
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-store"></i>
                                <span class="hide-menu"> Stall Mananagement </span>
                            </a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                @if(auth()->user()->access->maintenance_stall_management_ambulants)
                                <li class="sidebar-item">
                                    <a href="{{ route('main.ambulant-stalls.index') }}" class="sidebar-link {{ request()->routeIs('main.ambulant-stalls.*') ? 'active' : '' }}" wire:navigate>
                                        <i class=""></i>
                                        <span class="hide-menu"> Ambulant Stalls </span>
                                    </a>
                                </li>
                                @endif
                                @if(auth()->user()->access->maintenance_stall_management_stalls)
                                <li class="sidebar-item">
                                    <a href="{{ route('main.stalls.index') }}" class="sidebar-link {{ request()->routeIs('main.stalls.*') ? 'active' : '' }}" wire:navigate>
                                        <i class=""></i>
                                        <span class="hide-menu"> Stalls </span>
                                    </a>
                                </li>
                                @endif
                                @if(auth()->user()->access->maintenance_stall_management_stall_rates)
                                <li class="sidebar-item">
                                    <a href="{{ route('main.stall-rates.index') }}" class="sidebar-link {{ request()->routeIs('main.stall-rates.*') ? 'active' : '' }}" wire:navigate>
                                        <i class=""></i>
                                        <span class="hide-menu"> Stall Rates </span>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        @endif
                        @if (auth()->user()->access->maintenance_wet_dry_goods_items ||
                        auth()->user()->access->maintenance_wet_dry_goods_categories ||
                        auth()->user()->access->maintenance_wet_dry_goods_units)
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                    <i class="mdi mdi-food-variant" aria-hidden="true"></i>
                                    <span class="hide-menu"> Wet & Dry Goods </span>
                                </a>
                                <ul aria-expanded="false" class="collapse  first-level">
                                    @if(auth()->user()->access->maintenance_wet_dry_goods_items)
                                    <li class="sidebar-item">
                                        <a href="{{ route('main.goods.index') }}" class="sidebar-link {{ request()->routeIs('main.goods.*') ? 'active' : '' }}" wire:navigate>
                                            <i class=""></i>
                                            <span class="hide-menu"> Items </span>
                                        </a>
                                    </li>
                                    @endif
                                    @if(auth()->user()->access->maintenance_wet_dry_goods_categories)
                                    <li class="sidebar-item">
                                        <a href="{{ route('main.item-categories.index') }}" class="sidebar-link {{ request()->routeIs('main.item-categories.*') ? 'active' : '' }}" wire:navigate>
                                            <i class=""></i>
                                            <span class="hide-menu"> Item Categories </span>
                                        </a>
                                    </li>
                                    @endif
                                    @if(auth()->user()->access->maintenance_wet_dry_goods_units)
                                    <li class="sidebar-item">
                                        <a href="{{ route('main.units.index') }}" class="sidebar-link {{ request()->routeIs('main.units.*') ? 'active' : '' }}" wire:navigate>
                                            <i class=""></i>
                                            <span class="hide-menu"> Units </span>
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if (auth()->user()->access->maintenance_violation_types)
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-account-alert" aria-hidden="true"></i>
                                <span class="hide-menu"> Violations </span>
                            </a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                @if (auth()->user()->can("viewAny", App\Models\ViolationType::class))
                                <li class="sidebar-item">
                                    <a href="{{ route('main.violations.types.index') }}" class="sidebar-link {{ request()->routeIs('main.violations.types.*') ? 'active' : '' }}" wire:navigate>
                                        <i class=""></i>
                                        <span class="hide-menu"> Violation  Types </span>
                                    </a>
                                </li>   
                                @endif
                            </ul>
                        </li>
                        @endif
                        @if(auth()->user()->access->maintenance_fees_ambulants 
                        // || auth()->user()->access->maintenance_fees_tax_rate
                        )
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-ticket-percent" aria-hidden="true"></i>
                                <span class="hide-menu"> Fees </span>
                            </a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                @if (auth()->user()->access->maintenance_fees_ambulants)
                                <li class="sidebar-item">
                                    <a href="{{ route('main.fees.fee-settings') }}" class="sidebar-link {{ request()->routeIs('main.fees.fee-settings') ? 'active' : '' }}" wire:navigate>
                                        <i class="" aria-hidden="true"></i>
                                        <span class="hide-menu"> Ambulant Fees </span>
                                    </a>
                                </li>  
                                @endif
                                {{-- @if (auth()->user()->access->maintenance_fees_tax_rate)
                                <li class="sidebar-item">
                                    <a href="{{ route('main.fees.item-fee-settings') }}" class="sidebar-link {{ request()->routeIs('main.fees.item-fee-settings') ? 'active' : '' }}" wire:navigate>
                                        <i class="" aria-hidden="true"></i>
                                        <span class="hide-menu"> Wet & Dry Items Tax Rate </span>
                                    </a>
                                </li>
                                @endif --}}
                            </ul>
                        </li>
                        @endif
                    @endif

                    @if (auth()->user()->access->reports)    
                        <li class="nav-small-cap">
                            <i class="mdi mdi-dots-horizontal"></i>
                            <span class="hide-menu">Reports</span>
                        </li>

                        <li class="sidebar-item">
                            <a href="{{ route('main.reports.vendors-list') }}" class="sidebar-link {{ request()->routeIs('main.reports.vendors-list.*') ? 'active' : '' }}" wire:navigate>
                                <i class="mdi mdi-file-chart"></i>
                                <span class="hide-menu"> Vendor/Stallholders Masterlist</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('main.reports.rental-collection') }}" class="sidebar-link {{ request()->routeIs('main.reports.rental-collection.*') ? 'active' : '' }}" wire:navigate>
                                <i class="mdi mdi-file-chart"></i>
                                <span class="hide-menu"> Stall Rental Collections </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('main.reports.market-fee-collection') }}" class="sidebar-link {{ request()->routeIs('main.reports.market-fee-collection.*') ? 'active' : '' }}" wire:navigate>
                                <i class="mdi mdi-file-chart"></i>
                                <span class="hide-menu"> Market Fees Collections </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('main.reports.price-monitoring') }}" class="sidebar-link {{ request()->routeIs('main.reports.price-monitorin.*') ? 'active' : '' }}" wire:navigate>
                                <i class="mdi mdi-file-chart"></i>
                                <span class="hide-menu"> Price Monitoring </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('main.reports.fish-monitoring') }}" class="sidebar-link {{ request()->routeIs('main.reports.fish-monitoring.*') ? 'active' : '' }}" wire:navigate>
                                <i class="mdi mdi-file-chart"></i>
                                <span class="hide-menu"> Fish Monitoring </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('main.reports.market-violations') }}" class="sidebar-link {{ request()->routeIs('main.reports.market-violations.*') ? 'active' : '' }}" wire:navigate>
                                <i class="mdi mdi-file-chart"></i>
                                <span class="hide-menu"> Market Violations </span>
                            </a>
                        </li>
                    @endif

                    @if (auth()->user()->access->app_settings)
                        <li class="nav-small-cap">
                            <i class="mdi mdi-dots-horizontal"></i>
                            <span class="hide-menu">Settings</span>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('main.settings.index') }}" class="sidebar-link {{ request()->routeIs('main.settings.*') ? 'active' : '' }}" wire:navigate>
                                <i class="mdi mdi-wrench"></i>
                                <span class="hide-menu"> Application Settings </span>
                            </a>
                        </li>
                    @endif
                @endif

                {{-- VENDOR ONLY --}}
                @if (auth()->user()->isVendor())
                    <li class="sidebar-item">
                        <a href="{{ route('vendor.ambulant-stalls.index') }}" class="sidebar-link {{ request()->routeIs('vendor.ambulant-stalls..*') ? 'active' : '' }}" wire:navigate>
                            <i class="mdi mdi-store"></i>
                            <span class="hide-menu"> Ambulant Stalls </span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-cash-multiple"></i>
                            <span class="hide-menu"> Fees </span>
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item">
                                <a href="{{ route('vendor.fees.index') }}" class="sidebar-link {{ request()->routeIs('vendor.fees.*') ? 'active' : '' }}" wire:navigate>
                                    {{-- <i class="fa fa-ticket"></i> --}}
                                    <i class="mdi mdi-calendar-today"></i>
                                    <span class="hide-menu"> Daily Collection Fees</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('vendor.monthly-rents.index') }}" class="sidebar-link {{ request()->routeIs('vendor.monthly-rents.*') ? 'active' : '' }}" wire:navigate>
                                    {{-- <i class="fa fa-ticket"></i> --}}
                                    <i class="mdi mdi-calendar-multiple"></i>
                                    <span class="hide-menu"> Monthly Rents</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
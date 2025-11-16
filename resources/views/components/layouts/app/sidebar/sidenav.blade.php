<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
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
                @if (auth()->user()->isAdmin())
                    {{-- <li class="nav-small-cap">
                        <i class="mdi mdi-dots-horizontal"></i>
                        <span class="hide-menu">Admin</span>
                    </li> --}}
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"aria-expanded="false">
                            {{-- <i class="mdi mdi-account-settings"></i> --}}
                            <span class="hide-menu">User Management </span>
                            {{-- <span class="badge badge-pill badge-info ml-auto m-r-15">3</span> --}}
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            {{-- <li class="sidebar-item">
                                <a href="index.html" class="sidebar-link">
                                    <i class="mdi mdi-adjust"></i>
                                    <span class="hide-menu"> Classic </span>
                                </a>
                            </li> --}}
                            <li class="sidebar-item">
                                <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" wire:navigate>
                                    <i class="fas fa-users"></i>
                                    <span class="hide-menu"> Users </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            {{-- <i class="fas fa-sliders-h"></i> --}}
                            <span class="hide-menu">Others </span>
                            {{-- <span class="badge badge-pill badge-info ml-auto m-r-15">3</span> --}}
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            {{-- <li class="sidebar-item">
                                <a href="index.html" class="sidebar-link">
                                    <i class="mdi mdi-adjust"></i>
                                    <span class="hide-menu"> Classic </span>
                                </a>
                            </li> --}}
                            <li class="sidebar-item">
                                <a href="{{ route('admin.municipal-markets.index') }}" class="sidebar-link {{ request()->routeIs('admin.municipal-markets.*') ? 'active' : '' }}" wire:navigate>
                                    <i class="fas fa-store-alt"></i>
                                    <span class="hide-menu"> Public Markets </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (auth()->user()->isMarketSupervisor())
                    <li class="sidebar-item">
                        <a href="{{ route('main.suppliers.index') }}" class="sidebar-link {{ request()->routeIs('main.suppliers.*') ? 'active' : '' }}" wire:navigate>
                            <i class="mdi mdi-truck-delivery"></i>
                            <span class="hide-menu"> Suppliers </span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-store"></i>
                            <span class="hide-menu"> Stall Mananagement </span>
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item">
                                <a href="{{ route('main.vendors.index') }}" class="sidebar-link {{ request()->routeIs('main.vendors.*') || request()->routeIs('main.vendors.view.*') ? 'active' : '' }}" wire:navigate>
                                    <i class="mdi mdi-store"></i>
                                    <span class="hide-menu"> Vendors/Stall Holders </span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('main.ambulant-stalls.index') }}" class="sidebar-link {{ request()->routeIs('main.ambulant-stalls.*') ? 'active' : '' }}" wire:navigate>
                                    <i class="mdi mdi-store"></i>
                                    <span class="hide-menu"> Ambulant Stalls </span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('main.stalls.index') }}" class="sidebar-link {{ request()->routeIs('main.stalls.*') ? 'active' : '' }}" wire:navigate>
                                    <i class="mdi mdi-store"></i>
                                    <span class="hide-menu"> Stalls </span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('main.stall-rates.index') }}" class="sidebar-link {{ request()->routeIs('main.stall-rates.*') ? 'active' : '' }}" wire:navigate>
                                    <i class="mdi mdi-cash"></i>
                                    <span class="hide-menu"> Stall Rates </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-food-variant" aria-hidden="true"></i>
                            <span class="hide-menu"> Wet & Dry Goods Mangement </span>
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item">
                                <a href="{{ route('main.deliveries.index') }}" class="sidebar-link {{ request()->routeIs('main.deliveries.*') ? 'active' : '' }}" wire:navigate>
                                    <i class="fa fa-truck" aria-hidden="true"></i>
                                    <span class="hide-menu"> Wet & Dry Goods Deliveries </span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('main.goods.index') }}" class="sidebar-link {{ request()->routeIs('main.goods.*') ? 'active' : '' }}" wire:navigate>
                                    <i class="fa fa-list" aria-hidden="true"></i>
                                    <span class="hide-menu"> Items </span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('main.item-categories.index') }}" class="sidebar-link {{ request()->routeIs('main.item-categories.*') ? 'active' : '' }}" wire:navigate>
                                    <i class="mdi mdi-format-list-bulleted-type"></i>
                                    <span class="hide-menu"> Item Categories </span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('main.units.index') }}" class="sidebar-link {{ request()->routeIs('main.units.*') ? 'active' : '' }}" wire:navigate>
                                    <i class="mdi mdi-ruler"></i>
                                    <span class="hide-menu"> Units </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-account-alert" aria-hidden="true"></i>
                            <span class="hide-menu"> Violation Monitoring </span>
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item">
                                <a href="{{ route('main.violations.index') }}" class="sidebar-link {{ request()->routeIs('main.violations.*') ? 'active' : '' }}" wire:navigate>
                                    <i class="fa fa-list" aria-hidden="true"></i>
                                    <span class="hide-menu"> Violations </span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('main.violations.types.index') }}" class="sidebar-link {{ request()->routeIs('main.violations.types.*') ? 'active' : '' }}" wire:navigate>
                                    <i class="fa fa-list" aria-hidden="true"></i>
                                    <span class="hide-menu"> Violation  Types </span>
                                </a>
                            </li>   
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-ticket-percent" aria-hidden="true"></i>
                            <span class="hide-menu"> Fees Collection </span>
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item">
                                <a href="{{ route('main.fees.index') }}" class="sidebar-link {{ request()->routeIs('main.fees.*') ? 'active' : '' }}" wire:navigate>
                                    <i class="mdi mdi-ticket-percent" aria-hidden="true"></i>
                                    <span class="hide-menu"> Daily Collection Fees </span>
                                </a>
                            </li>  
                        </ul>
                    </li>
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
                    <li class="nav-small-cap">
                        <i class="mdi mdi-dots-horizontal"></i>
                        <span class="hide-menu">Reports</span>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('main.settings.index') }}" class="sidebar-link {{ request()->routeIs('main.settings.*') ? 'active' : '' }}" wire:navigate>
                            <i class="mdi mdi-chart-pie"></i>
                            <span class="hide-menu"> Reports </span>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->isAdminAide())
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <span class="hide-menu"> Stall Mananagement </span>
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item">
                                <a href="{{ route('main.vendors.index') }}" class="sidebar-link {{ request()->routeIs('main.vendors.*') ? 'active' : '' }}" wire:navigate>
                                    <i class="mdi mdi-store"></i>
                                    <span class="hide-menu"> Vendors/Stall Holders </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
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
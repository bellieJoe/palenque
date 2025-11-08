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
                            <span class="hide-menu"> Stall Mananagement </span>
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item">
                                <a href="{{ route('main.stall-rates.index') }}" class="sidebar-link {{ request()->routeIs('main.stall-rates.*') ? 'active' : '' }}" wire:navigate>
                                    <i class="mdi mdi-store"></i>
                                    <span class="hide-menu"> Stall Rates </span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('main.stalls.index') }}" class="sidebar-link {{ request()->routeIs('main.stalls.*') ? 'active' : '' }}" wire:navigate>
                                    <i class="mdi mdi-store"></i>
                                    <span class="hide-menu"> Stalls </span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('main.vendors.index') }}" class="sidebar-link {{ request()->routeIs('main.vendors.*') || request()->routeIs('main.vendors.view.*') ? 'active' : '' }}" wire:navigate>
                                    <i class="mdi mdi-store"></i>
                                    <span class="hide-menu"> Vendors/Stall Holders </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <span class="hide-menu"> Wet & Dry Goods Mangement </span>
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
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
                        </ul>
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
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
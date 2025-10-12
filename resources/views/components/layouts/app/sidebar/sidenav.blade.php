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
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Admin</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false">
                        <i class="mdi mdi-account-settings"></i>
                        <span class="hide-menu">User Maintenance </span>
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
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false">
                        <i class="fas fa-sliders-h"></i>
                        <span class="hide-menu">Maintenance </span>
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
                @if (auth()->user()->isMarketSupervisor() || auth()->user()->isAdminAide())
                <li class="sidebar-item">
                    <a href="{{ route('main.suppliers.index') }}" class="sidebar-link {{ request()->routeIs('main.suppliers.*') ? 'active' : '' }}" wire:navigate>
                        <i class="mdi mdi-truck-delivery"></i>
                        <span class="hide-menu"> Suppliers </span>
                    </a>
                    <a href="{{ route('main.stalls.index') }}" class="sidebar-link {{ request()->routeIs('main.stalls.*') ? 'active' : '' }}" wire:navigate>
                        <i class="mdi mdi-store"></i>
                        <span class="hide-menu"> Stalls </span>
                    </a>
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
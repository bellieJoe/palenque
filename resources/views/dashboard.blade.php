<x-layouts.app :title="__('Dashboard')">
    @if (auth()->user()->isMarketSupervisor() || auth()->user()->isMarketSpecialist() || auth()->user()->isAdminAide() || auth()->user()->isMarketInspector())
        @livewire('dashboard.market-dashboard')
    @endif
    @if (auth()->user()->isAdmin())
        @livewire('dashboard.admin-dashboard')
    @endif
    @if(auth()->user()->isVendor())
        @livewire('dashboard.vendor-dashboard')
    @endif
</x-layouts.app>

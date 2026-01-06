<x-layouts.app :title="__('Dashboard')">
    @if (auth()->user()->isAdmin())
        @livewire('dashboard.admin-dashboard')
    @endif
    @if (auth()->user()->isMarketInspector() || auth()->user()->isMarketSupervisor() || auth()->user()->isAdminAide() || auth()->user()->isMarketSpecialist() || auth()->user()->isMarketInspector() || auth()->user()->isMarketAdmin())
        @livewire('dashboard.market-dashboard')
    @endif
    @if (auth()->user()->isVendor())
        @livewire('dashboard.vendor-dashboard')
    @endif
</x-layouts.app>

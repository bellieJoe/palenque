<div>
@if (auth()->user()->isMarketSupervisor() || auth()->user()->isMarketSpecialist() || auth()->user()->isAdminAide() || auth()->user()->isMarketInspector())
    <div class="d-flex justify-content-center mb-4">
        <div class="form-inline mr-2">
            <label for="">From &nbsp;&nbsp;&nbsp;</label>
            <input type="date" class="form-control" wire:model.live="startFilter">
        </div>
        <div class="form-inline">
            <label for="">To &nbsp;&nbsp;&nbsp;</label>
            <input type="date" class="form-control" wire:model.live="endFilter">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-7">
                            <i class="fa-solid fa-users font-20 text-purple"></i>
                            <p class="font-16 m-b-5">Vendors</p>
                        </div>
                        <div class="col-5">
                            <h1 class="font-light text-right mb-0">{{ number_format($vendorCount, 0, '.', ',') }}</h1>
                        </div>
                    </div>
                </div>
            </div>                        
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-7">
                            <i class="fa-solid fa-store font-20 text-danger"></i>
                            <p class="font-16 m-b-5">Stalls</p>
                        </div>
                        <div class="col-5">
                            <h1 class="font-light text-right mb-0">{{ number_format($stallCount, 0, '.', ',') }}</h1>
                        </div>
                    </div>
                </div>
            </div>                        
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-7">
                            <i class="fa-solid fa-user-tag font-20 text-info"></i>
                            <p class="font-16 m-b-5">Ambulant Stalls</p>
                        </div>
                        <div class="col-5">
                            <h1 class="font-light text-right mb-0">{{ number_format($ambulantStallCount, 0, '.', ',') }}</h1>
                        </div>
                    </div>
                </div>
            </div>                        
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-7">
                            <i class="fa-solid fa-boxes-packing font-20 text-success"></i>
                            <p class="font-16 m-b-5">Suppliers</p>
                        </div>
                        <div class="col-5">
                            <h1 class="font-light text-right mb-0">{{ number_format($supplierCount, 0, '.', ',') }}</h1>
                        </div>
                    </div>
                </div>
            </div>                        
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-center">Vendors with Highest Count of Violations</h5>
                    <div 
                        class="" 
                        wire:ignore
                        x-data
                        x-init="
                            let options = {
                                chart: {
                                    type: 'bar'
                                },
                                plotOptions: {
                                    bar: {
                                        horizontal: true
                                    }
                                },
                                series: [{
                                    data: @js($mostViolatedVendorData)
                                }]
                            }
                            let chart = new ApexCharts($refs.chart, options);
                            chart.render();
                            Livewire.on('updateMostViolatedVendorChart', (payload) => {
                                chart.updateSeries([{ data: payload[0].data }]);
                            });
                        "
                        >
                            <div x-ref="chart"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-center">Top Suppliers</h5>
                    <div 
                        class="" 
                        wire:ignore
                        x-data
                        x-init="
                            let options = {
                                chart: {
                                    type: 'bar'
                                },
                                plotOptions: {
                                    bar: {
                                        horizontal: true
                                    }
                                },
                                series: [{
                                    data: @js($topSuppliersData)
                                }]
                            }
                            let chart = new ApexCharts($refs.chart, options);
                            chart.render();
                            Livewire.on('updateTopSuppliersChart', (payload) => {
                                chart.updateSeries([{ data: payload[0].data }]);
                            });
                        "
                        >
                            <div x-ref="chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-center">Market Fee Collection</h5>
                    <div 
                        class="" 
                        wire:ignore
                        x-data
                        x-init="
                            let options = {
                                chart: {
                                    type: 'line'
                                },
                                stroke: {
                                curve: 'smooth',
                                },
                                series: [
                                    {
                                    name: 'Series A',
                                    data: [1.4, 2, 2.5, 1.5, 2.5, 2.8, 3.8, 4.6]
                                    },
                                    {
                                    name: 'Series B',
                                    data: [20, 29, 37, 36, 44, 45, 50, 58]
                                    }
                                ],
                            }
                            let chart = new ApexCharts($refs.chart, options);
                            chart.render();
                            Livewire.on('updatePublicMarketUserChart', (payload) => {
                                chart.updateSeries([{ data: payload[0].data }]);
                            });
                        "
                        >
                            <div x-ref="chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
</div>
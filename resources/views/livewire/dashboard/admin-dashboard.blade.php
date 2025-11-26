<div>
    @if (auth()->user()->isAdmin())
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
                            <p class="font-16 m-b-5">Users</p>
                        </div>
                        <div class="col-5">
                            <h1 class="font-light text-right mb-0">{{ number_format($userCount, 0, '.', ',') }}</h1>
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
                            <i class="fa-solid fa-building-wheat font-20 text-danger"></i>
                            <p class="font-16 m-b-5">Public Markets</p>
                        </div>
                        <div class="col-5">
                            <h1 class="font-light text-right mb-0">{{ number_format($marketCount, 0, '.', ',') }}</h1>
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
        <div class="col col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-center">Users</h5>
                    <div 
                        class="" 
                        wire:ignore
                        x-data="{ chart: null }"
                        x-init="
                        let options = {
                            chart: { type: 'line' },
                            series: [{
                                name: 'Registered Users',
                                data: @js($userTrendData)
                            }],
                            xaxis: {
                                type: 'datetime',
                                categories: @js($userTrendCategories)
                            },
                            stroke: {
                                curve: 'smooth',
                            }
                        }
                        let chart = new ApexCharts($refs.userTrendsChart, options);
                        chart.render();

                        Livewire.on('updateUserTrendChart', (payload) => {
                            chart.updateSeries([{ data: payload[0].data }]);
                            chart.updateOptions({
                                xaxis: { categories: payload[0].categories }
                            });
                        });
                    "
                    >
                        <div x-ref="userTrendsChart"></div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="text-center">Users per Public Market</h5>
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
                                data: @js($publicMarketUsersData)
                            }]
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
        <div class="col col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-center">User Role Distribution</h5>
                    <div 
                    class="" 
                    wire:ignore
                    x-data
                    x-init="
                        let options = {
                            chart: {
                                type: 'donut'
                            },
                            series: @js($userDistributionData),
                            labels: @js($userDistributionCategories)
                        }
                        let chart = new ApexCharts($refs.chart, options);
                        chart.render();

                        Livewire.on('updateUserDistributionChart', (payload) => {
                            chart.updateSeries([{ data: payload[0].data }]);
                            chart.updateLabels([{ data: payload[0].categories }]);
                        });
                    "
                    >
                        <div x-ref="chart"></div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="text-center">Stalls per Public Market</h5>
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
                                data: @js($publicMarketStallsData)
                            }]
                        }
                        let chart = new ApexCharts($refs.chart, options);
                        chart.render();
                        Livewire.on('updatePublicMarketStallChart', (payload) => {
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

<div>
    @if (auth()->user()->isVendor())
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
                                <i class="fa-solid fa-store font-20 text-warning"></i>
                                <p class="font-16 m-b-5">Rented Stalls</p>
                            </div>
                            <div class="col-5">
                                <h1 class="font-light text-right mb-0">{{ number_format($stallsCount, 0, '.', ',') }}</h1>
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
                                <i class="fa-solid fa-store font-20 text-purple"></i>
                                <p class="font-16 m-b-5">Ambulant Stalls</p>
                            </div>
                            <div class="col-5">
                                <h1 class="font-light text-right mb-0">{{ number_format($ambulantStallsCount, 0, '.', ',') }}</h1>
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
                                <i class="fa-solid fa-triangle-exclamation font-20 text-warning"></i>
                                <p class="font-16 m-b-5">Violations</p>
                            </div>
                            <div class="col-5">
                                <h1 class="font-light text-right mb-0">{{ number_format($violationsCount, 0, '.', ',') }}</h1>
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
                                <i class="fa-solid fa-users font-20 text-purple"></i>
                                <p class="font-16 m-b-5">Violations</p>
                            </div>
                            <div class="col-5">
                                <h1 class="font-light text-right mb-0">{{ number_format($ambulantStallsCount, 0, '.', ',') }}</h1>
                            </div>
                        </div>
                    </div>
                </div>                        
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-center">Daily Collection Fees</h5>
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
                                    xaxis: {
                                        type: 'datetime',
                                        categories: @js($dailyFeesCollectionCategories)
                                    },
                                    yaxis: {
                                        labels: {
                                            formatter: function (value) {
                                                return '₱' + value.toLocaleString();
                                            }
                                        }
                                    },
                                    tooltip: {
                                        y: {
                                            formatter: function (value) {
                                                return '₱' + value.toLocaleString();
                                            }
                                        }
                                    },
                                    series: [
                                        {
                                            name: 'Daily Collections',
                                            data: @js($dailyCollectionData)
                                        },
                                    ],
                                }
                                let chart = new ApexCharts($refs.chart, options);
                                chart.render();
                                Livewire.on('updateMarketFeesChart', (payload) => {
                                    chart.updateSeries([
                                        {
                                            name: 'Daily Collections',
                                            data: payload[0].dailyCollectionData
                                        }
                                    ]);
                                    chart.updateXaxis({ categories: payload[0].categories });
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

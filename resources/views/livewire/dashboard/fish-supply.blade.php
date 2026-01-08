<div>
    <div class="card">
        <div class="card-header">
            <h6 class="card-title">Fish Supply</h6>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="">
                        <label for="">Start Date</label>
                        <input type="date" class="form-control" wire:model.live="startFilter">
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="">
                        <label for="">End Date</label>
                        <input type="date" class="form-control" wire:model.live="endFilter">
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="text-center">Fish Supply</h5>
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
                                    name: 'Total',
                                    data: @js($data)
                                }]
                            }
                            let chart = new ApexCharts($refs.chart, options);
                            chart.render();
                            Livewire.on('updatData', (payload) => {
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
</div>

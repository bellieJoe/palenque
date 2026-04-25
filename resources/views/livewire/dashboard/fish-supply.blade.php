<div>
    <div class="card">
        <div class="card-body">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-center">Product Monitor</h5><br>
                    <div class="row mb-2 justify-content-center">
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="">
                                <select wire:model.live="productFilter" class="form-control form-control-sm">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="">
                                <input type="date" class="form-control form-control-sm" wire:model.live="startFilter">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="">
                                <input type="date" class="form-control form-control-sm" wire:model.live="endFilter">
                            </div>
                        </div>
                    </div>
                    <div 
                        class="" 
                        wire:ignore
                        x-data
                        x-init="
                            let options = {
                                chart: {
                                    type: 'bar',
                                    height: 300,
                                    title: {
                                        text: 'Total Product'
                                    }
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
                            Livewire.on('updateData', (payload) => {
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

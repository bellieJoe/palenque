<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="text-center mb-4">Market Price History</h5>

                {{-- Filters --}}
                <div class="d-flex justify-content-center mb-4 flex-wrap">
                    <div class="form-inline mr-2 mb-2">
                        <label class="mr-2">Type:</label>
                        <select wire:model.live="typeFilter" class="form-control">
                            <option value="">-Select Type-</option>
                            <option value="WET">Wet Goods</option>
                            <option value="DRY">Dry Goods</option>
                        </select>
                    </div>

                    <div class="form-inline mr-2 mb-2">
                        <label class="mr-2">Item:</label>
                        <select wire:model.live="itemFilter" class="form-control">
                            <option value="">-Select Item-</option>
                            @foreach($itemOptions as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-inline mr-2 mb-2">
                        <label class="mr-2">From:</label>
                        <input type="date" wire:model.live="startFilter" class="form-control">
                    </div>

                    <div class="form-inline mb-2">
                        <label class="mr-2">To:</label>
                        <input type="date" wire:model.live="endFilter" class="form-control">
                    </div>
                </div>

                {{-- Chart --}}
                <div 
                    wire:ignore
                    x-data
                    x-init="
                        let options = {
                            chart: {
                                type: 'candlestick',
                                height: 350,
                            },
                            series: [{
                                data: @js($series)
                            }],
                            xaxis: {
                                type: 'datetime'
                            },
                            yaxis: {
                                tooltip: {
                                    enabled: true
                                }
                            }
                        };
                        let chart = new ApexCharts($refs.chart, options);
                        chart.render();

                        Livewire.on('updatePriceHistoryChart', payload => {
                            console.log(payload);
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

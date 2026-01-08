<div>
    <x-page-header title="Price Monitoring" />
    <div class="d-flex justify-content-end mb-3">
        {{-- @livewire('main.vendor.vendor-create') --}}
        <button class="btn btn-primary" onclick="printReport()">Print</button>
    </div>
    <div class="card">
        <div class="card-body">
            
            <div class="row mb-3">
                <select name="" id="" wire:model.live.debounce.300ms="reportType" class="form-control col-12 col-lg-3 col-md-6">
                    <option value="Daily">Daily</option>
                    <option value="Weekly">Weekly</option>
                    {{-- <option value="Monthly">Monthly</option> --}}
                    {{-- <option value="Yearly">Yearly</option> --}}
                </select>
                @if ($reportType == "Daily")
                <div class="col-12 col-lg-3 col-md-6">
                    <input type="date" class="form-control" wire:model.live.debounce.300ms="collectionDate">
                </div>
                @endif
                @if ($reportType == "Weekly")
                <div class="col-12 col-lg-3 col-md-6">
                    <input type="week" class="form-control" wire:model.live.debounce.300ms="collectionWeek">
                </div>
                @endif
                @if ($reportType == "Monthly")
                <div class="col-12 col-lg-3 col-md-6">
                    <input type="month" class="form-control" wire:model.live.debounce.300ms="collectionMonth">
                </div>
                @endif
                {{-- @if ($reportType == "Yearly")
                <div class="col-12 col-lg-3 col-md-6">
                    <select id="yearSelect" class="form-control" wire:model.live.debounce.300ms="collectionYear">
                        <option value="">Select year</option>
                        @for ($year = now()->year; $year >= 2022; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>
                @endif --}}
            </div>
            <div id="printable">
                @livewire('components.report-logo')
                <h3 class="text-center">
                    Price Monitoring Report
                </h3>
                <h6 class="text-center">
                    As of   
                    @if ($reportType == "Daily")
                        {{ Illuminate\Support\Carbon::parse($collectionDate)->format('F d, Y') }}&nbsp;
                    @elseif($reportType == "Monthly")
                        {{ Illuminate\Support\Carbon::parse($collectionMonth)->format('F Y') }}&nbsp;
                    @elseif($reportType == "Yearly")
                        {{ $collectionYear }}&nbsp;
                    @endif
                </h6>
                <br><br><br>
                <table class="table table-hovered  table-bordered" style="min-width: 1000px">
                    <thead class="thead-light">
                        <th>Item</th>
                        <th>From</th>
                        <th>To</th>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            @forelse ($item->priceMonitoringRecords as $kp => $price)
                            <tr>
                                <td class="border-bottom-0 border-top-0">{{ $kp == 0 ? $item->name : '' }}</td>
                                {{-- <td>{{ $price ? 'PHP ' . number_format($price->price, 2, '.', ',') : 'Not Set' }}</td>
                                <td>{{ $price ? 'PHP ' . number_format($price->price_max, 2, '.', ',') : 'Not Set' }}</td> --}}
                                <td>{{ \App\Models\Item::getAverageMinPrice($reportType, ($reportType == "Daily" ? $collectionDate : ($reportType == "Monthly" ? $collectionMonth : $collectionWeek)), $item->id ) }}</td>
                                <td>{{ \App\Models\Item::getAverageMaxPrice($reportType, ($reportType == "Daily" ? $collectionDate : ($reportType == "Monthly" ? $collectionMonth : $collectionWeek)), $item->id ) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td colspan="2" class="text-center">No Price Set</td>
                            </tr>
                            @endforelse
                            <tr>
                                <td colspan="3"></td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center">No Items Found</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
    function printReport() {
        printJS({
            printable: 'printable',
            type: 'html',
            targetStyles: ['*'],
            style: `
                @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

                body {
                    font-family: 'Roboto', sans-serif;
                }

                table { width: 100%; border-collapse: collapse; }
                th, td { border: 1px solid #000; padding: 5px; }
                th { background-color: #f0f0f0; }
                h3, p { text-align: center; }
            `
        });
    }
    </script>
</div>
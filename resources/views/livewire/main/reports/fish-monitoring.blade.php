<div>
    <x-page-header title="Fish Monitoring Report" />
    <div class="d-flex justify-content-end mb-3">
        {{-- @livewire('main.vendor.vendor-create') --}}
        <button class="btn btn-primary" onclick="printReport()">Print</button>
    </div>
    <div class="card">
        <div class="card-body">
            
            <div class="row mb-3">
                <select name="" id="" wire:model.live.debounce.300ms="reportType" class="form-control col-12 col-lg-3 col-md-6">
                    <option value="Daily">Daily</option>
                    <option value="Monthly">Monthly</option>
                    <option value="Yearly">Yearly</option>
                </select>
                @if ($reportType == "Daily")
                <div class="col-12 col-lg-3 col-md-6">
                    <input type="date" class="form-control" wire:model.live.debounce.300ms="collectionDate">
                </div>
                @endif
                @if ($reportType == "Monthly")
                <div class="col-12 col-lg-3 col-md-6">
                    <input type="month" class="form-control" wire:model.live.debounce.300ms="collectionMonth">
                </div>
                @endif
                @if ($reportType == "Yearly")
                <div class="col-12 col-lg-3 col-md-6">
                    <select id="yearSelect" class="form-control" wire:model.live.debounce.300ms="collectionYear">
                        <option value="">Select year</option>
                        @for ($year = now()->year; $year >= 2022; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>
                @endif
            </div>
            <div id="printable">
                @livewire('components.report-logo')
                <h3 class="text-center">
                    @if ($reportType == "Daily")
                        {{ Illuminate\Support\Carbon::parse($collectionDate)->format('F d, Y') }}&nbsp;
                    @elseif($reportType == "Monthly")
                        {{ Illuminate\Support\Carbon::parse($collectionMonth)->format('F Y') }}&nbsp;
                    @elseif($reportType == "Yearly")
                        {{ $collectionYear }}&nbsp;
                    @endif
                    Fish Monitoring Report
                </h3>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" style="min-width: 1000px">
                        <thead>
                            <tr>
                                <th class="align-middle text-center" rowspan="2">NAME/KIND/SPECIES</th>
                                <th class="align-middle text-center" rowspan="2">QTY(KGS.)</th>
                                <th class="align-middle text-center" colspan="2">MARKET VALUE</th>
                                <th class="align-middle text-center" rowspan="2" class="text-center">ORIGIN</th>
                            </tr>
                            <tr>
                                <th class="align-middle text-center">FROM</th>
                                <th class="align-middle text-center">TO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5"><b>Local</b></td>
                            </tr>
                            @forelse ($dataLocal as $item)
                                <tr>
                                    <td class="align-middle">{{ $item->item_name }}</td>
                                    <td>{{ number_format($item->total, 2, '.', ',') }}</td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $item->origin_name }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="text-center">No data found</td></tr>
                            @endforelse
                            <tr>
                                <td colspan="5"><b>Imported</b></td>
                            </tr>
                            @forelse ($dataImport as $item)
                                <tr>
                                    <td class="align-middle">{{ $item->item_name }}</td>
                                    <td>{{ number_format($item->total, 2, '.', ',') }}</td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $item->origin_name }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="text-center">No data found</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{-- <div class="row">
                    <div class="col-12">
                        <p class="text-end"><b>Total:</b> Php {{ number_format($feeCollections->sum('amount'), 2, ',', '.') }}</p>
                    </div>
                </div> --}}
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

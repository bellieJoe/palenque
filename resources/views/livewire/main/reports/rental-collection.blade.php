<div>
    <x-page-header title="Rental Collection" />
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
                    Rental Collection Report
                </h3>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" style="min-width: 1000px">
                        <thead>
                            <th>Stall</th>
                            <th class="">Vendor</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Bill Date</th>
                        </thead>
                        <tbody>
                            @forelse ($rentalCollections as $collection)
                                <tr>
                                    <td class="align-middle">{{ $collection->stallContract->stallOccupant->stall->name }}</td>
                                    <td class="align-middle ">{{ $collection->stallContract->stallOccupant->vendor->name }}</td>
                                    <td class="align-middle text-center">Php {{ number_format($collection->amount_paid, 2, ',', '.') }}</td>
                                    <td class="align-middle text-center">{{ $collection->bill_date->format('F d, Y') }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center">No Collections Found</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p class="text-end"><b>Total:</b> Php {{ number_format($rentalCollections->sum('amount_paid'), 2, ',', '.') }}</p>
                    </div>
                </div>
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

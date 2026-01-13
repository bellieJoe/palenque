<div>
    <style>
        #supervisor-name{
            display: none;
        }
    </style>
    <x-page-header title="Market Violation Report" />
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
                    Market Violation Report
                </h3>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" style="min-width: 1000px">
                        <thead>
                            <th>Vendor</th>
                            <th class="">Violation</th>
                            <th class="">Date Issued</th>
                            <th class="text-center">Penalty</th>
                            <th class="text-center">Status</th>
                        </thead>
                        <tbody>
                            @forelse ($marketViolations as $violation)
                                <tr>
                                    <td class="align-middle">{{ $violation->vendor->name }}</td>
                                    <td class="align-middle">{{ $violation->violationType->name }}</td>
                                    <td class="align-middle">{{ $violation->created_at->format('F d, Y') }}</td>
                                    <td class="align-middle">{{ $violation->violationType->penalty_type == 'MONETARY' ? $violation->violationType->monetary_penalty : $violation->violationType->service_penalty }}</td>
                                    <td class="align-middle">{{ $violation->status }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center">No Market Fees Found</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-12">
                        {{-- <p>{{ $marketViolations->where("violation_count", > 3)->where("status", "PAID") }}</p> --}}
                        <p class="text-end"><b>Total Violations Issued:</b> {{ number_format($marketViolations->count(), 0, '.', ',') }}</p>
                    </div>
                </div>
                <br><br><br><br>
                <div class="">
                    <div class="d-flex justify-content-end">
                        <div class="">
                            <select class="form-control" name="" id="supervisor-select" onchange="onSupervisorSelect()">
                                <option value="">-Select Supervisor-</option>
                                @foreach (auth()->user()->supervisors as $supervisor)
                                    <option value="{{ $supervisor->name }}">{{$supervisor->name}}</option>
                                @endforeach
                            </select>
                            <h4 class="text-center mb-0" id="supervisor-name" ></h4>
                            __________________________________________
                            <p class="text-center">Market Supervisor</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    function onSupervisorSelect(){
        var supervisor = $('#supervisor-select').val();
        console.log(supervisor);
        document.getElementById('supervisor-name').innerHTML = supervisor;
    }
    
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
                .d-flex { display: flex; }
                .justify-content-end { justify-content: end; }
                #supervisor-select { display: none; }
                #supervisor-name { display: block; text-align: center; margin-bottom: 0px; }
            `
        });
    }
    </script>
</div>

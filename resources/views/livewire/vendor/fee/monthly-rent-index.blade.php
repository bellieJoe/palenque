<div>
    <x-page-header title="Monthly Rents" />
    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-wrap align-items-center mb-3">
                <label for="" class="mb-0 p-1">Sort By </label>
                <select name="" id="" class="form-control ml-2 p-1" style="width: 200px;" wire:model.live.debounce.300ms="sortColumn">
                    <option value="">-Select Column-</option>
                    <option value="due_date">Due Date</option>
                    <option value="status">Status</option>
                </select>
                <select name="" id="" class="form-control ml-2 p-1" style="width: 200px;" wire:model.live.debounce.300ms="sortOrder">
                    <option value="">-Select Order-</option>
                    <option value="desc">Descending</option>
                    <option value="asc">Ascending</option>
                </select>
            </div>
            <div class="d-flex flex-wrap align-items-center mb-3">
                <label for="" class="mb-0 p-1">Filter By </label>
                <div class="input-group p-1" style="max-width: 300px">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Start Date</span>
                    </div>
                    <input type="date" class="form-control" wire:model.live.debounce.300ms="filterDueDateStart" placeholder="Start Date"/>
                </div>
                <div class="input-group p-1" style="max-width: 300px">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">End Date</span>
                    </div>
                    <input type="date" class="form-control" wire:model.live.debounce.300ms="filterDueDateEnd" placeholder="End Date"/>
                </div>
                <div class="input-group p-1" style="max-width: 300px">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Status</span>
                    </div>
                    <select name="" id="" class="form-control" style="width: 200px;" wire:model.live.debounce.300ms="filterStatus">
                        <option value="">-Select Status-</option>
                        <option value="PAID">Paid</option>
                        <option value="WAIVED">Waived</option>
                        <option value="UNPAID">Unpaid</option>
                    </select>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Stall</th>
                            <th>Amount</th>
                            <th>Due Date</th>
                            <th>Penalty</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($monthlyRents as $monthlyRent)
                            <tr>
                                <td>{{ $monthlyRent->stallContract->stallOccupant->stall->name }}</td>
                                <td>Php {{ number_format($monthlyRent->amount, 2, '.', ',') }}</td>
                                <td>{{ $monthlyRent->due_date->format('F d, Y') }}</td>
                                <td>
                                    @if ($monthlyRent->status == "PAID")
                                        Php {{ number_format($monthlyRent->amount_paid - $monthlyRent->amount, 2, '.', ',') }}
                                    @elseif ($monthlyRent->status == "UNPAID" && $monthlyRent->due_date->isPast())
                                        {{ $monthlyRent->penalty ? 'Php ' . number_format($monthlyRent->penalty, 2, '.', ',') : 'N/A' }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td><span class="badge badge-{{ $monthlyRent->status == 'PAID' ? 'success' : ($monthlyRent->status == 'UNPAID' && $monthlyRent->due_date->isPast() ? 'danger' : 'secondary') }}">{{ $monthlyRent->status }}</span></td>
                                <td>
                                    @if ($monthlyRent->status == 'UNPAID' && $monthlyRent->due_date->lt(now()->addMonth(1)) && auth()->user()->vendor->appSettings()->enable_online_payment)
                                         <button class="btn btn-outline-primary" wire:click="payOnline({{ $monthlyRent->id }}, 'gcash')">Pay via Gcash</button>
                                        <button class="btn btn-outline-primary" wire:click="payOnline({{ $monthlyRent->id }}, 'paymaya')">Pay via Paymaya</button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center">No Unpaid Rents Found</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

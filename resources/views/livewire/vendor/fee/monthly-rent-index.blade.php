<div>
    <x-page-header title="Monthly Rents" />
    <div class="card">
        <div class="card-body">
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

<div>
    <x-page-header title="Fees" />
    <div class="d-flex justify-content-end mb-3">
        <a class="btn btn-primary" href="{{ route('main.fees.create') }}">Create Ticket/Fee</a>
    </div>
    <div class="card">
        <div class="card-body">
            <input type="text" class="form-control mb-3" wire:model.live.debounce.300ms="search" placeholder="Search Ticket No...">
            <div class="table-responsive">
                <table class="table table-hovered" style="min-width: 1000px">
                    <thead>
                        <th>Vendor</th>
                        <th>Amount</th>
                        <th>Date Issued</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @forelse ($fees as $fee)
                            <tr>
                                <td class="align-middle">{{ $fee->ambulantStall->vendor->name }}</td>
                                <td class="align-middle">Php {{ number_format($fee->amount, 2, '.', ',') }}</td>
                                <td class="align-middle">{{ $fee->date_issued->format('F d, Y') }}</td>
                                <td class="align-middle">
                                    <span class="badge badge-{{ $fee->status == 'PAID' ? 'success' : ($fee->status == 'UNPAID' ? 'secondary' : 'warning') }}">{{ $fee->status }}</span>
                                </td>
                                <td class="align-middle">
                                    @if ($fee->status == 'UNPAID')
                                        {{-- <button class="btn btn-outline-warning" wire:click="waive({{ $fee->id }})" wire:confirm="Are you sure you want to waive this fee?">Waive</button> --}}
                                        <a class="btn btn-outline-primary" href="{{  route('main.fees.update-daily-fee', $fee->id) }}" wire:navigate>Pay Php {{ number_format($fee->amount, 2, '.', ',') }}</a>
                                    @endif
                                    {{-- <a class="btn btn-outline-primary" href="{{ route('main.violations.view', $vendor->id) }}" wire:navigate>View Violations</a> --}}
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center">No Fees Found</td></tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $fees->links() }}
            </div>
        </div>
    </div>
</div>

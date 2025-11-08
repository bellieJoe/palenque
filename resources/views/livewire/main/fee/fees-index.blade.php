<div>
    <x-page-header title="Fees" />
    <div class="d-flex justify-content-end mb-3">
        <a class="btn btn-primary" href="{{ route('main.fees.create') }}">Create Ticket/Fee</a>
    </div>
    <div class="card">
        <div class="card-body">
            <input type="text" class="form-control mb-3" wire:model.live.debounce.300ms="search" placeholder="Search Vendor or Supplier...">
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
                                <td class="align-middle">{{ $fee }}</td>
                                <td class="align-middle">{{ $fee }}</td>
                                <td class="align-middle">{{ $fee }}</td>
                                <td class="align-middle">{{ $fee }}</td>
                                <td class="align-middle">
                                    {{-- <a class="btn btn-outline-primary" href="{{ route('main.violations.view', $vendor->id) }}" wire:navigate>View Violations</a>
                                    <a class="btn btn-outline-primary" href="{{ route('main.violations.create', $vendor->id) }}" wire:navigate>Add Violation</a> --}}
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

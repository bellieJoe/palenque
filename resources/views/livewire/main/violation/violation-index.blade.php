<div>
    <x-page-header title="Violations" />
    <div class="d-flex justify-content-end mb-3">
        <a class="btn btn-primary" href="{{ route('main.violations.types.create') }}">Add Violation Type</a>
    </div>
    <div class="card">
        <div class="card-body">
            <input type="text" class="form-control mb-3" wire:model.live.debounce.300ms="search" placeholder="Search Stall or Vendor...">
            <div class="table-responsive">
                <table class="table table-hovered" style="min-width: 1000px">
                    <thead>
                        <th>Vendor Name</th>
                        <th>Unresolved Violations</th>
                        <th>Resolved Violations</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @forelse ($vendors as $vendor)
                            <tr>
                                <td class="align-middle">{{ $vendor->name }}</td>
                                <td class="align-middle text-danger" title="View Violations">{{ number_format($vendor->unresolvedViolations->count(), 0, '.', ',') }}</td>
                                <td class="align-middle text-success" title="View Violations">{{ number_format($vendor->resolvedViolations->count(), 0, '.', ',') }}</td>
                                <td class="align-middle">
                                    <a class="btn btn-outline-primary" href="{{ route('main.violations.view', $vendor->id) }}" wire:navigate>View Violations</a>
                                    <a class="btn btn-outline-primary" href="{{ route('main.violations.create', $vendor->id) }}" wire:navigate>Add Violation</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center">No Vendors Found</td></tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $vendors->links() }}
            </div>
        </div>
    </div>
</div>

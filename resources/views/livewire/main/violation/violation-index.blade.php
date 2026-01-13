<div>
    <x-page-header title="Violations" />
    {{-- <div class="d-flex justify-content-end mb-3">
        @can('create', \App\Models\Main\Violation::class)
        <a class="btn btn-primary" href="{{ route('main.violations.create') }}">Add Violation</a>
        @endcan
    </div> --}}
    <div class="card">
        <div class="card-body">
            <input type="text" class="form-control mb-3" wire:model.live.debounce.300ms="search" placeholder="Search Stall or Vendor...">
            <div class="table-responsive">
                <table class="table table-hovered" style="min-width: 1000px">
                    <thead>
                        <th>Vendor Name</th>
                        <th>Stall</th>
                        <th>Waived Violations</th>
                        <th>Unresolved Violations</th>
                        <th>Resolved Violations</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @forelse ($stallOccupants as $stallOccupant)
                            <tr>
                                <td class="align-middle">{{ $stallOccupant->vendor->name }}</td>
                                <td class="align-middle">
                                    {{ $stallOccupant->stall->name }}
                                </td>
                                <td class="align-middle text-warning" title="View Violations">{{ number_format($stallOccupant->waivedViolations->count(), 0, '.', ',') }}</td>
                                <td class="align-middle text-danger" title="View Violations">{{ number_format($stallOccupant->unresolvedViolations->count(), 0, '.', ',') }}</td>
                                <td class="align-middle text-success" title="View Violations">{{ number_format($stallOccupant->resolvedViolations->count(), 0, '.', ',') }}</td>
                                <td class="align-middle">
                                    @can('create', \App\Models\Main\Violation::class)
                                        <a class="btn btn-outline-primary" href="{{ route('main.violations.view', $stallOccupant->id) }}" wire:navigate>View Violations</a>
                                        <a class="btn btn-outline-primary" href="{{ route('main.violations.create', $stallOccupant->vendor->id) }}" wire:navigate>Add Violation</a>
                                        @if ($stallOccupant->violations->count() > 3)
                                            <button class="btn btn-outline-primary" wire:confirm="Are you sure you want to terminate this contract?" wire:click="terminateContract({{$stallOccupant->id}})">Terminate Contract</button>
                                        @endif
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center">No Vendors Found</td></tr>
                        @endforelse
                        {{-- @forelse ($vendors as $vendor)
                            <tr>
                                <td class="align-middle">{{ $vendor->name }}</td>
                                <td class="align-middle text-danger" title="View Violations">{{ number_format($vendor->unresolvedViolations->count(), 0, '.', ',') }}</td>
                                <td class="align-middle text-success" title="View Violations">{{ number_format($vendor->resolvedViolations->count(), 0, '.', ',') }}</td>
                                <td class="align-middle">
                                    @can('create', \App\Models\Main\Violation::class)
                                    <a class="btn btn-outline-primary" href="{{ route('main.violations.view', $vendor->id) }}" wire:navigate>View Violations</a>
                                    <a class="btn btn-outline-primary" href="{{ route('main.violations.create', $vendor->id) }}" wire:navigate>Add Violation</a>
                                    
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center">No Vendors Found</td></tr>
                        @endforelse --}}
                    </tbody>
                </table>
                {{ $vendors->links() }}
            </div>
        </div>
    </div>
</div>

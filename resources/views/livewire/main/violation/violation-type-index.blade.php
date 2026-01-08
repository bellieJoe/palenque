<div>
    <x-page-header title="Violation Types" />
    <div class="d-flex justify-content-end mb-3">
        <a class="btn btn-primary" href="{{ route('main.violations.types.create') }}">Add Violation Type</a>
    </div>
    <div class="card">
        <div class="card-body">
            <input type="text" class="form-control mb-3" wire:model.live.debounce.300ms="search" placeholder="Search Violation Type...">
            <div class="table-responsive">
                <table class="table table-hovered" style="min-width: 1000px">
                    <thead>
                        {{-- <th>Code</th> --}}
                        <th>Name</th>
                        <th>Penalty Type</th>
                        <th>Monetary Penalty</th>
                        {{-- <th>Service Penalty</th> --}}
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @forelse ($violationTypes as $violationType)
                            <tr>
                                {{-- <td class="align-middle">{{ $violationType->code }}</td> --}}
                                <td class="align-middle">{{ $violationType->name }}</td>
                                <td class="align-middle">{{ $violationType->penalty_type }}</td>
                                <td class="align-middle">Php {{ number_format($violationType->monetary_penalty, 2, '.', ',') }}</td>
                                {{-- <td class="align-middle">{{ $violationType->service_penalty }}</td> --}}
                                <td class="align-middle">
                                    <a class="btn btn-outline-primary" href="{{ route('main.violations.types.view', $violationType->id) }}" wire:navigate>View</a>
                                    <button class="btn btn-outline-danger" wire:click="deleteViolationType({{$violationType->id}})" wire:confirm="Are you sure you want to delete this Vaiolation?">Delete</button>
                                    <a class="btn btn-outline-primary" href="{{ route('main.violations.types.edit', $violationType->id) }}" wire:navigate>Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center">No Violations Found</td></tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $violationTypes->links() }}
            </div>
        </div>
    </div>
</div>

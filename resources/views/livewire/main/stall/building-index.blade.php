<div>
    <x-page-header title="Buildings" />
    <div class="d-flex justify-content-end mb-3">
        <a class="btn btn-primary" href="{{ route('main.buildings.create') }}">Add Building</a>
    </div>
    <div class="card">
        <div class="card-body">
            <input type="text" class="form-control mb-3" wire:model.live.debounce.300ms="search" placeholder="Search Buildings...">
            <div class="table-responsive">
                <table class="table table-hovered" style="min-width: 1000px">
                    <thead>
                        <th>Building Name</th>
                        <th>No. of Stalls</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @forelse ($buildings as $building)
                            <tr>
                                <td class="align-middle">{{ $building->name }}</td>
                                <td class="align-middle">{{ $building->stalls->count() }}</td>
                                <td class="align-middle">
                                   <button class="btn btn-ouline-danger btn-sm" wire:confirm="Are you sure you want to delete this building?" wire:click="deleteBuilding({{$building->id}})">Delete</button>
                                   <a href="{{ route('main.buildings.edit', $building->id) }}" wire:navigate class="btn btn-outline-primary">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center">No buildings Found</td></tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $buildings->links() }}
            </div>
        </div>
    </div>
</div>

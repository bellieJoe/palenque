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
                                    {{-- @can('update', $ambulantStall)
                                        <button class="btn btn-outline-danger" wire:click="deleteAmbulantStall({{$ambulantStall->id}})"  wire:confirm="Are you sure you want to delete this Ambulant Stall? This action is irreversible.">Delete Stall</button>
                                        <a class="btn btn-outline-primary" href="{{ route('main.ambulant-stalls.edit', $ambulantStall->id) }}" wire:navigate>Edit Stall</a>
                                    @endcan
                                    @can('create', \App\Models\Fee::class)
                                        <a class="btn btn-outline-warning" href="{{ route('main.fees.issue-daily-fee', $ambulantStall->id) }}" wire:navigate>Issue Ticket</a>
                                    @endcan --}}
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

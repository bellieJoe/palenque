<div>
    @livewire('main.stall.stall-edit')
    @livewire('main.stall.set-occupant')
    <x-page-header title="Stalls" />
    <div class="d-flex justify-content-end mb-2">
        @livewire('main.stall.stall-create')
    </div>
    <div class="card">
        <div class="card-body">
            <input type="text" class="form-control mb-3" wire:model.live.debounce.300ms="search" placeholder="Search Stalls...">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th>Name</th>
                        <th>Occupancy Status</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @forelse ($stalls as $stall)
                            <tr>
                                <td>{{ $stall->name }}</td>
                                <td>
                                    @if ($stall->activeOccupant)
                                        Occupied by {{ $stall->activeOccupant->vendor->name }}
                                    @else
                                        <button class="btn btn-outline-success" wire:click="setOccupant({{$stall->id}})">Set Occupant</button>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-outline-danger" wire:click="deleteStall({{$stall->id}})" wire:confirm="Are you sure you want to delete this post?">Delete</button>
                                    <button class="btn btn-outline-primary" wire:click="editStall({{$stall->id}})">Edit</button>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="2" class="text-center">No Stalls Found</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

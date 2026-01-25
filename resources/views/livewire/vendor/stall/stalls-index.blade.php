<div>
    <x-page-header title="Rented Stalls" />
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
                        <th>Area</th>
                        <th>Rate</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @forelse ($stallOccupants as $stallOccupant)
                            <tr>
                                <td>{{ $stallOccupant->stall->name }}</td>
                                <td>{{ $stallOccupant->stall->area }} sqm</td>
                                <td>Php {{ number_format($stallOccupant->stall->stallRate->rate, 2, '.', ',')}}</td>
                                <td>
                                    {{-- @if (!$stall->trashed())
                                        <button class="btn btn-outline-danger" wire:click="deleteStall({{$stall->id}})" wire:confirm="Are you sure you want to delete this post?">Delete</button>
                                        <button class="btn btn-outline-primary" wire:click="editStall({{$stall->id}})">Edit</button>
                                    @endif
                                    @if ($stall->trashed())
                                        <button class="btn btn-outline-danger" wire:click="restoreStall({{$stall->id}})" wire:confirm="Are you sure you want to restore this post?">Restore ({{ number_format(now()->diffInDays($stall->restore_date), 0) }} days left)</button>
                                    @endif --}}
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center">No Stalls Found</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div>
    <x-page-header title="Ambulant Stalls" />
    <div class="d-flex justify-content-end mb-3">
        <a class="btn btn-primary" href="{{ route('main.ambulant-stalls.create') }}">Add Ambulant Stall</a>
    </div>
    <div class="card">
        <div class="card-body">
            <input type="text" class="form-control mb-3" wire:model.live.debounce.300ms="search" placeholder="Search Ambulant Stalls...">
            <div class="table-responsive">
                <table class="table table-hovered" style="min-width: 1000px">
                    <thead>
                        <th>Stall No.</th>
                        <th>Stall Name</th>
                        <th>Vendor</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @forelse ($ambulantStalls as $ambulantStall)
                            <tr>
                                <td class="align-middle">{{ $ambulantStall->stall_no }}</td>
                                <td class="align-middle">{{ $ambulantStall->name }}</td>
                                <td class="align-middle">{{ $ambulantStall->vendor->name }}</td>
                                <td class="align-middle">
                                    <span class="badge badge-{{ $ambulantStall->status == 1 ? 'success' : 'secondary' }}">
                                        {{ $ambulantStall->status == 1 ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="align-middle">
                                    <button class="btn btn-outline-danger" wire:click="deleteAmbulantStall({{$ambulantStall->id}})"  wire:confirm="Are you sure you want to delete this Ambulant Stall? This action is irreversible.">Delete Stall</button>
                                    <a class="btn btn-outline-primary" href="{{ route('main.ambulant-stalls.edit', $ambulantStall->id) }}" wire:navigate>Edit Stall</a>
                                    <a class="btn btn-outline-warning" href="{{ route('main.fees.issue-daily-fee', $ambulantStall->id) }}" wire:navigate>Issue Ticket</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center">No Stalls Found</td></tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $ambulantStalls->links() }}
            </div>
        </div>
    </div>
</div>

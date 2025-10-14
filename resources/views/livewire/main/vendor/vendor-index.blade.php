<div>
    <x-page-header title="Vendors/Stall Holders" />
    <div class="d-flex justify-content-end mb-3">
        @livewire('main.vendor.vendor-create')
    </div>
    <div class="card">
        <div class="card-body">
            <input type="text" class="form-control mb-3" wire:model.live.debounce.300ms="search" placeholder="Search Vendors...">
            <div class="table-responsive">
                <table class="table table-hovered">
                    <thead>
                        <th>Name</th>
                        <th>Representative</th>
                        <th>Contact Number</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @forelse ($vendors as $vendor)
                            <tr>
                                <td>{{ $vendor->name }}</td>
                                <td>{{ $vendor->representative_name }}</td>
                                <td>{{ $vendor->contact_number }}</td>
                                <td>{{ $vendor->user->email }}</td>
                                <td>
                                    <button class="btn btn-outline-danger" wire:click="deleteVendor({{$vendor->id}})" wire:confirm="Are you sure you want to delete this post?">Delete</button>
                                    {{-- <button class="btn btn-outline-primary" wire:click="editVendor({{$vendor->id}})">Edit</button> --}}
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

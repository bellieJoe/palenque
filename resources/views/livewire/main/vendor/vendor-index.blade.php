<div>
    <x-page-header title="Vendors" />
    <div class="d-flex justify-content-end mb-3">
        @livewire('main.vendor.vendor-create')
    </div>
    <div class="card">
        <div class="card-body">
            <input type="text" class="form-control mb-3" wire:model.live.debounce.300ms="search" placeholder="Search Vendors...">
            <div class="table-responsive">
                <table class="table table-hovered" style="min-width: 1000px">
                    <thead>
                        <th>Name</th>
                        <th>Stalls Occupied</th>
                        <th>Representative</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @forelse ($vendors as $vendor)
                            <tr>
                                <td class="align-middle">{{ $vendor->name }}</td>
                                <td class="align-middle"><a href="#">{{ $vendor->stallOccupants->count() }}  stall/s</a> </td>
                                <td class="align-middle">{{ $vendor->representative_name }}</td>
                                <td class="align-middle">{{ $vendor->address }}</td>
                                <td class="align-middle">{{ $vendor->contact_number }}</td>
                                <td class="align-middle">{{ $vendor->user->email }}</td>
                                <td class="align-middle">
                                    
                                    <a class="btn btn-outline-primary" href="{{ route('main.vendors.view', $vendor->id)}}" wire:navigate>View</a>
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

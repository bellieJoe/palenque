<div>
    @livewire('main.supplier.supplier-edit')
    <x-page-header title="Suppliers" />
    {{-- <div class="">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12 p-1">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="p-2">
                                <h5 class="font-weight-bold">Total Suppliers</h5>
                                <h5 class="font-weight-bold">0</h5>
                            </div>
                            <div class="p-2">
                                <h5 class="font-weight-bold">Total Items</h5>
                                <h5 class="font-weight-bold">0</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="d-flex justify-content-end mb-2">
        @livewire('main.supplier.supplier-create')
    </div>
    <div class="card">
        <div class="card-body">
            <input type="text" class="form-control mb-3" wire:model.live.debounce.300ms="search" placeholder="Search Suppliers...">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @forelse ($suppliers as $supplier)
                            <tr>
                                <td>{{ $supplier->name }}</td>
                                <td>{{ $supplier->address }}</td>
                                <td>{{ $supplier->contact_number }}</td>
                                <td>{{ $supplier->email }}</td>
                                <td>
                                    <button class="btn btn-outline-danger" wire:click="deleteSupplier({{$supplier}})" wire:confirm="Are you sure you want to delete this post?">Delete</button>
                                    <button class="btn btn-outline-primary" wire:click="editSupplier({{$supplier->id}})">Edit</button>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center">No Suppliers Found</td></tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $suppliers->links() }}
            </div>
        </div>
    </div>
</div>

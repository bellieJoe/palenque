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
        <a class="btn btn-primary" href="{{ route("main.origins.create")}}">Add Origin</a>&nbsp;
        @livewire('main.supplier.supplier-create')
    </div>
    <div class="card">
        <div class="card-header">
            <h6 class="card-title">Origins</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th>Name</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @forelse ($origins as $origin)
                            <tr>
                                <td>{{ $origin->name }} ({{ $origin->is_local ? "Local" : "Import" }})</td>
                                <td>
                                    <button class="btn btn-outline-danger" wire:click="deleteOrigin({{$origin->id}})" wire:confirm="Are you sure you want to delete this origin?">Delete</button>
                                    <a class="btn btn-outline-primary" href="{{ route("main.origins.edit" , $origin->id) }}">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="2" class="text-center">No Suppliers Found</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
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
                                <td>{{ $supplier->origin ? $supplier->origin->name : "" }}</td>
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

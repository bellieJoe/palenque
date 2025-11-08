<div>
     @livewire('main.vendor.assign-vendor')
    <div class="card">
        <div class="card-header">
            <h6 class="card-title"><a class="btn btn-sm btn-outline-secondary border-0" href="{{ route('main.vendors.index') }}" wire:navigate><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a> Vendor Profile</h6>
        </div>
        <div class="card-body">
            <h5 class="font-weight-bold">Basic Information</h5>
            <div class="row">
                <div class="col-lg-4 mb-2">
                    <label class="small mb-0 text-muted">Name</label>
                    <div>{{ $vendor->name }}</div>
                </div>
                <div class="col-lg-4 mb-2">
                    <label class="small mb-0 text-muted">Representative</label>
                    <div>{{ $vendor->representative_name }}</div>
                </div>
                <div class="col-lg-4 mb-2">
                    <label class="small mb-0 text-muted">Contact Number</label>
                    <div>{{ $vendor->contact_number }}</div>
                </div>
                <div class="col-lg-4 mb-2">
                    <label class="small mb-0 text-muted">Email</label>
                    <div>{{ $vendor->user->email }}</div>
                </div>
            </div>

            <hr>
            <div class="d-flex justify-content-between">
                <h5 class="font-weight-bold">Assigned Stalls</h5>
                <button class="btn btn-primary" wire:click="showAssignStallModal">Assign & Create Contract</button>
            </div>
            <br>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Stall</th>
                            <th>Contract Status</th>
                            <th>Monthly Rent</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($stalls as $stall)
                            <tr>
                                <td>{{ $stall->stall->name }}</td>
                                <td><span class="badge badge-{{ $stall->active_contract ? 'info' : 'danger' }}">{{ $stall->active_contract ? 'Active' : 'Expired' }}</span></td>
                                <td>Php {{ number_format($stall->active_contract->rate->rate, 2, '.', ',') }}</td>
                                <td>
                                {{-- <button class="btn btn-outline-primary" >Create Contract</button> --}}
                                    <button class="btn btn-outline-danger" wire:click="deleteStall({{$stall->id}})" wire:confirm="Are you sure you want to remove this stall?">Remove</button>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center">No Stalls Found</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <hr>
            <div class="d-flex justify-content-between">
                <h5 class="font-weight-bold">Monthly Rent</h5>
                {{-- <button class="btn btn-primary" wire:click="showAssignStallModal">Assign Stall</button> --}}
            </div>
        </div>
    </div>
</div>

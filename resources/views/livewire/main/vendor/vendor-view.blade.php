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
                            <th>Contract Duration</th>
                            <th>Monthly Rent</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($stalls as $stall)
                            <tr>
                                <td>{{ $stall->stall->name }}</td>
                                <td><span class="badge badge-{{ $stall->active_contract ? 'info' : 'danger' }}">{{ $stall->active_contract ? 'Active' : 'Expired' }}</span></td>
                                <td>{{ $stall->active_contract ? $stall->active_contract->from->format('F d, Y') . ' to ' . $stall->active_contract->to->format('F d, Y') : 'N/A' }} </td>
                                <td>
                                    @if ($stall->active_contract)
                                        Php {{ number_format($stall->active_contract->monthlyRents->first()->amount, 2, '.', ',') }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    {{-- @if ($stall->active_contract)
                                        <button class="btn btn-outline-primary" wire:confirm="Are you sure you want to terminate this contract?" wire:click="terminateContract({{$stall->id}})">Terminate Contract</button>
                                    @endif --}}
                                    <button class="btn btn-outline-danger" wire:click="deleteStall({{$stall->id}})" wire:confirm="Are you sure you want to remove this stall?">Remove</button>
                                    <a  class="btn btn-success" target="_blank" href="{{ route('main.vendors.print-contract', $stall->active_contract->id)}}">Print Contract</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center">No Stalls Found</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <hr>
            <div class="">
                <h5 class="font-weight-bold">Unpaid Rents</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Stall</th>
                                <th>Amount</th>
                                <th>Due Date</th>
                                <th>Penalty</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($monthlyRents as $monthlyRent)
                                <tr>
                                    <td>{{ $monthlyRent->stallContract->stallOccupant->stall->name }}</td>
                                    <td>Php {{ number_format($monthlyRent->amount, 2, '.', ',') }}</td>
                                    <td>{{ $monthlyRent->due_date->format('F d, Y') }}</td>
                                    <td>
                                        @if ($monthlyRent->status == "PAID")
                                            Php {{ number_format($monthlyRent->amount_paid - $monthlyRent->amount, 2, '.', ',') }}
                                        @elseif ($monthlyRent->status == "UNPAID" && $monthlyRent->due_date->isPast())
                                            {{ $monthlyRent->penalty ? 'Php ' . number_format($monthlyRent->penalty, 2, '.', ',') : 'N/A' }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td><span class="badge badge-{{ $monthlyRent->status == 'PAID' ? 'success' : ($monthlyRent->status == 'UNPAID' && $monthlyRent->due_date->isPast() ? 'danger' : 'secondary') }}">{{ $monthlyRent->status }}</span></td>
                                    <td>
                                        @if ($monthlyRent->status == 'UNPAID' )
                                            <button class="btn btn-outline-warning" wire:confirm="Are you sure you want to waive this rent?" wire:click="rentPaymentWaive({{$monthlyRent->id}})">Waive</button>
                                            <button class="btn btn-outline-success" wire:confirm="Are you sure you want this payment to be paid?" wire:click="rentPaymentPaid({{$monthlyRent->id}})">Paid</button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center">No Unpaid Rents Found</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>
            <div class="">
                <h4 >Attachments</h4>
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <small>Business/Mayor's Permit</small>
                        <p>
                            <a href="{{ Storage::url('business_permit/'.$vendor->business_permit) }}" target="_blank">
                                Click to View
                            </a>
                        </p>
                    </div>
                    <div class="col-12 col-lg-4">
                        <small>DTI Permit</small>
                        <p>
                            <a href="{{ Storage::url('dti_permit/'.$vendor->dti_permit) }}" target="_blank">
                                Click to View
                            </a>
                        </p>
                    </div>
                    <div class="col-12 col-lg-4">
                        <small>BIR Registration</small>
                        <p>
                            <a href="{{ Storage::url('bir_registration/'.$vendor->bir_registration) }}" target="_blank">
                                Click to View
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

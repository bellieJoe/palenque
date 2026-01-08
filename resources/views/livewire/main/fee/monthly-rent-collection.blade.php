<div>
    <x-page-header title="Monthly Rents" />
     <div class="card">
        <div class="card-body">
            <div class="row mb-2 justify-content-center">
                <div class="col col-lg-4 col-md-6">
                    <input type="month" class="form-control" placeholder="Select Month" wire:model.live.debounce.300ms="monthFilter"  >
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Due Date</th>
                            <th scope="col">Stall Name</th>
                            <th scope="col">Vendor</th>
                            <th scope="col">Status</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($monthlyRents as $monthlyRent)
                            <tr>
                                <td class="align-middle">{{ $monthlyRent->due_date->format('F d, Y') }}</td>
                                <td class="align-middle">
                                    <i class="fa-solid fa-store"></i>
                                    {{ $monthlyRent->stallContract->stallOccupant->stall->name }}
                                </td>
                                <td class="align-middle">
                                    <img src="https://api.dicebear.com/9.x/identicon/svg?seed={{ $monthlyRent->stallContract->stallOccupant->vendor->avatar_url }}" class="img-thumbnail rounded-circle" width="40" height="40" alt="{{ $monthlyRent->stallContract->stallOccupant->vendor->name }}">
                                    {{ $monthlyRent->stallContract->stallOccupant->vendor->name }}
                                </td>
                                <td class="align-middle"><span class="badge badge-{{ $monthlyRent->status == 'PAID' ? 'success' : ($monthlyRent->status == 'UNPAID' ? 'warning' : 'secondary') }}">{{ $monthlyRent->status }}</span></td>
                                <td class="align-middle">PHP {{ number_format($monthlyRent->amount, 2, ',', '.') }}</td>
                                <td class="align-middle">
                                    @if ($monthlyRent->status == "UNPAID")
                                        <button class="btn btn-outline-warning" wire:confirm="Are you sure you want to waive this rent?" wire:click="rentPaymentWaive({{$monthlyRent->id}})">Waive</button>
                                        <button class="btn btn-outline-success" wire:confirm="Are you sure you want this payment to be paid?" wire:click="rentPaymentPaid({{$monthlyRent->id}})">Paid</button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center">No Monthly Rents Found</td></tr>
                        @endforelse
                    </tbody>
                </table>
        </div>
     </div>
</div>

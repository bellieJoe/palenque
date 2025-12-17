<div>
    <x-page-header title="Ambulant Daily Collection" />
    <div class="card">
        <div class="card-body">
            <div class="row mb-2 justify-content-center">
                <div class="col col-lg-4 col-md-6">
                    <input type="date" class="form-control" placeholder="Date" wire:model="dateFilter">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Stall Name</th>
                            <th scope="col">Vendor</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ambulantStalls as $stall)
                            <tr>
                                <td>{{ $dateFilter }}</td>
                                <td>{{ $stall->name }}</td>
                                <td>{{ $stall->vendor->name }}</td>
                                <td></td>
                                <td>
                                    @if (!$collectedFees->contains('owner_id', $stall->id))
                                        <button class="btn btn-outline-primary">Issue Ticket</button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center">No Ambulant Stalls Found</td></tr
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

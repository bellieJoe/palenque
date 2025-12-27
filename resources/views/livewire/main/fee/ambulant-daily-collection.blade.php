<div>
    <x-page-header title="Ambulant Daily Collection" />
    <div class="card">
        <div class="card-body">
            <div class="row mb-2 justify-content-center">
                <div class="col col-lg-4 col-md-6">
                    <input type="date" class="form-control" placeholder="Date" wire:model.live="dateFilter">
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
                                <td>
                                    @if ($collectedFees->where('owner_id', $stall->id)->first())
                                        <span class="badge badge-{{ $collectedFees->where('owner_id', $stall->id)->first()->status == 'PAID' ? 'success' : ($collectedFees->where('owner_id', $stall->id)->first()->status == 'UNPAID' ? 'secondary' : 'warning') }}">{{ $collectedFees->where('owner_id', $stall->id)->first()->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if (!$collectedFees->contains('owner_id', $stall->id))
                                        <button class="btn btn-outline-primary" wire:click="openIssueTicketModal({{ $stall->id }})">Issue Ticket</button>
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

    <div class="modal fade" id="issueTicketModal" wire:ignore tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Issue Ticket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="stall_id" id="stall_id"  wire:model.lazy="stallId">
                    @error('stallId') <span class="text-danger">{{ $message }}</span> @enderror

                    <div class="mb-2">
                        <label for="">Amount</label>
                        <input type="text" class="form-control" name="amount" id="amount" wire:model.debounce.300ms="amount" >
                        @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-2">
                        <label for="">Status</label>
                        <select name="status" id="status" class="form-control" wire:model.debounce.300ms="status">
                            <option value="-Select Status-"></option>
                            <option value="PAID">PAID</option>
                            <option value="UNPAID">UNPAID</option>
                            <option value="WAIVED">WAIVED</option>
                        </select>
                        @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:loading.attr="disabled"  wire:click="storeTicket">Save</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('close-issue-ticket-modal', () => {
            $('#issueTicketModal').modal('hide'); // Bootstrap
        });
        window.addEventListener('show-issue-ticket-modal', () => {
            $('#issueTicketModal').modal('show');
        });
        function openIssueTicketModal(stall) {
            // You can use the stallId to fetch stall details if needed
            $('#stall_id').val(stall.id);
            $('#issueTicketModal').modal('show');
        }
    </script>
</div>

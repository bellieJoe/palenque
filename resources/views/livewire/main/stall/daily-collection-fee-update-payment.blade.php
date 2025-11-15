<div>
    <x-page-header title="Daily Collection Fees" />
    <div class="card" >
        <div class="card-header">
            <h6 class="card-title">Issue Ticket</h6>
        </div>
        <div class="card-body">
            <div class="border p-3 mb-3">
                <div class="row">
                    <div class="col-lg-4 mb-2">
                        <label class="small mb-0 text-muted">Vendor</label>
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
                    <div class="col-lg-4 mb-2">
                        <label class="small mb-0 text-muted">Stall Name</label>
                        <div>{{ $ambulantStall->name }}</div>
                    </div>
                    <div class="col-lg-4 mb-2">
                        <label class="small mb-0 text-muted">Ticket No.</label>
                        <div>{{ $fee->ticket_no }}</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="mb-2 col-lg-4 col-md-6 col-12">
                    <label for="receipt_no" class="form-label">Receipt No. <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="receipt_no" wire:model.live.debounce.300ms="receipt_no">
                    @error('receipt_no') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-2 col-lg-4 col-md-6 col-12">
                    <label for="date_paid" class="form-label">Date Paid <span class="text-date_paid">*</span></label>
                    <input type="date" class="form-control" id="date_paid" wire:model.live.debounce.300ms="date_paid">
                    @error('date_paid') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-2 col-lg-4 col-md-6 col-12">
                    <label for="remarks" class="form-label">Remarks <span class="text-danger">*</span></label>
                    <textarea  class="form-control" id="remarks" wire:model.live.debounce.300ms="remarks"></textarea>
                    @error('remarks') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="d-flex justify-content-end ">
                <a type="button" class="btn btn-secondary" href="{{ route('main.fees.index') }}" wire:navigate>Cancel</a>
                <button type="button" class="btn btn-primary ml-2" wire:click="submit" wire:loading.attr="disabled">Update Payment</button>
            </div>
        </div>
    </div>
</div>

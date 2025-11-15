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
                </div>
            </div>
            <div class="row">
                <div class="mb-2 col-lg-4 col-md-6 col-12">
                    <label for="amount" class="form-label">Amount (Php) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="name" wire:model.live.debounce.300ms="amount">
                    @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-2 col-lg-4 col-md-6 col-12">
                    <label for="amount" class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" id="status" class="form-control" wire:model.live.debounce.300ms="status">
                        <option value="-Select Status-"></option>
                        <option value="PAID">PAID</option>
                        <option value="UNPAID">UNPAID</option>
                        <option value="WAIVED">WAIVED</option>
                    </select>
                    @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="d-flex justify-content-end ">
                <a type="button" class="btn btn-secondary" href="{{ route('main.ambulant-stalls.index') }}" wire:navigate>Cancel</a>
                <button type="button" class="btn btn-primary ml-2" wire:click="storeDailyCollectionFee" wire:loading.attr="disabled">Save Ticket</button>
            </div>
        </div>
    </div>
</div>

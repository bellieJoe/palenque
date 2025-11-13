<div>
    <x-page-header title="Violations" />
    <div class="card">
        <div class="card-header">
            <h6 class="card-title">Add Violation</h6>
        </div>
        <div class="card-body">
            <div class="border p-3 mb-2">
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
                </div>
            </div>
            <div class="row">
                <div class="mb-2 col col-lg-4 col-md-6">
                    <label for="stall" class="form-label">Stall <span class="text-danger">*</span></label>
                    <select type="text" class="form-control" id="stall" wire:model.live.debounce.300ms="stall">
                        <option value="">Select Stall</option>
                        @foreach ($stalls as $stall)
                            <option value="{{ $stall->stall->id }}">{{ $stall->stall->name }}</option>
                        @endforeach
                    </select>
                    @error('stall') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-2 col col-lg-4 col-md-6">
                    <label for="violation" class="form-label">Violation <span class="text-danger">*</span></label>
                    <select type="text" class="form-control" id="code" wire:model.live.debounce.300ms="violation">
                        <option value="">Select Violation</option>
                        @foreach ($violationTypes as $violationType)
                            <option value="{{ $violationType->id }}">{{ $violationType->name }}</option>
                        @endforeach
                    </select>
                    @error('violation') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="d-flex justify-content-end ">
                <a type="button" class="btn btn-secondary" href="{{ route('main.violations.index') }}" wire:navigate>Cancel</a>
                <button type="button" class="btn btn-primary ml-2" wire:click="storeViolation" wire:loading.attr="disabled">Save Violation</button>
            </div>
        </div>
    </div>
</div>

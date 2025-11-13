<div>
    <x-page-header title="Violation Types" />
    <div class="card">
        <div class="card-header">
            <h6 class="card-title">Add Violation Type</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="mb-2 col col-lg-4 col-md-6">
                    <label for="code" class="form-label">Code <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="code" wire:model.live.debounce.300ms="code">
                    @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-2 col col-lg-4 col-md-6">
                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" wire:model.live.debounce.300ms="name">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-2 col col-lg-4 col-md-6">
                    <label for="penalty_type" class="form-label">Penalty Type <span class="text-danger">*</span></label>
                    <select type="text" class="form-control" id="penalty_type" wire:model.live.debounce.300ms="penalty_type">
                        <option value="">Select Penalty Type</option>
                        <option value="MONETARY">Monetary</option>
                        <option value="SERVICE">Service</option>
                    </select>
                    @error('penalty_type') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                @if ($penalty_type == "MONETARY")
                    <div class="mb-2 col col-lg-4 col-md-6">
                        <label for="penalty_amount" class="form-label">Penalty Amount <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="penalty_amount" wire:model.live.debounce.300ms="penalty_amount">
                        @error('penalty_amount') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                @endif
                @if ($penalty_type == "SERVICE")
                    <div class="mb-2 col col-lg-4 col-md-6">
                        <label for="penalty_service" class="form-label">Penalty Service <span class="text-danger">*</span></label>
                        <textarea  class="form-control" id="penalty_service" wire:model.live.debounce.300ms="penalty_service"></textarea>
                        @error('penalty_service') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                @endif
            </div>
            <div class="d-flex justify-content-end ">
                <a type="button" class="btn btn-secondary" href="{{ route('main.violations.types.index') }}" wire:navigate>Cancel</a>
                <button type="button" class="btn btn-primary ml-2" wire:click="storeViolationType" wire:loading.attr="disabled">Save Violation Type</button>
            </div>
        </div>
    </div>
</div>

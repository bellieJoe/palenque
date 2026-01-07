<div class="card mb-3">
    <div class="card-body">
        <h5 class="font-weight-bold">Contract Settings</h5>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="mb-3">
                    <label for="">Municipality Name</label>
                    <input type="text" class="form-control" wire:model.lazy="municipality_name">
                    @error('municipality_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="mb-3">
                    <label for="">Mayor's Name</label>
                    <input type="text" class="form-control" wire:model.lazy="mayor_name">
                    @error('mayor_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="mb-3">
                    <label for="">Municipal Address</label>
                    <input type="text" class="form-control" wire:model.lazy="municipal_address">
                    @error('municipal_address') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        <button class="btn btn-sm btn-primary" type="button" wire:loading.attr="disabled" wire:click="updateContractSettings()">Update</button>
    </div>
</div>
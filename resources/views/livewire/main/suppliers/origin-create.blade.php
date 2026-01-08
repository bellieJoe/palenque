<div>
    <x-page-header title="Units" />
    <div class="card" style="max-width: 500px">
        <div class="card-header">
            <h6 class="card-title">Add Origin</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="mb-2 col-12 ">
                    <label for="name" class="form-label">Address <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="address" wire:model.live.debounce.300ms="address">
                    @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-2 col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="is_local" wire:model.live.debounce.300ms="is_local">
                        <label class="form-check-label" for="is_local">
                            Local
                        </label>
                        @error('is_active') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end ">
                <a type="button" class="btn btn-secondary" href="{{ route('main.units.index') }}" wire:navigate>Cancel</a>
                <button type="button" class="btn btn-primary ml-2" wire:click="storeOrigin" wire:loading.attr="disabled">Save Origin</button>
            </div>
        </div>
    </div>
</div>

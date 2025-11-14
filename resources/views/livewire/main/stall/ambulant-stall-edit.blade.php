<div>
    <x-page-header title="Ambulant Stalls" />
    <div class="card" style="max-width: 500px">
        <div class="card-header">
            <h6 class="card-title">Edit Ambulant Stall</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="mb-2 col">
                    <label for="name" class="form-label">Unit <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" wire:model.live.debounce.300ms="name">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="d-flex justify-content-end ">
                <a type="button" class="btn btn-secondary" href="{{ route('main.ambulant-stalls.index') }}" wire:navigate>Cancel</a>
                <button type="button" class="btn btn-primary ml-2" wire:click="updateAmbulantStall" wire:loading.attr="disabled">Save Ambulant Stall</button>
            </div>
        </div>
    </div>
</div>

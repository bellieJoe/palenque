<div>
    <x-page-header title="Ambulant Stalls" />
    <div class="card">
        <div class="card-header">
            <h6 class="card-title">Add Ambulant Stall</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="mb-2 col col-lg-4 col-md-6">
                    <label for="vendor" class="form-label">Vendor <span class="text-danger">*</span></label>
                    <select type="text" class="form-control" id="vendor" wire:model.live.debounce.300ms="vendor">
                        <option value="">Select Vendor</option>
                        @foreach ($vendors as $vendor)
                            <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                        @endforeach
                    </select>
                    @error('vendor') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-2 col col-lg-4 col-md-6">
                    <label for="name" class="form-label"    >Stall Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" wire:model.live.debounce.300ms="name">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="d-flex justify-content-end ">
                <a type="button" class="btn btn-secondary" href="{{ route('main.ambulant-stalls.index') }}" wire:navigate>Cancel</a>
                <button type="button" class="btn btn-primary ml-2" wire:click="storeAmbulantStall" wire:loading.attr="disabled">Save Ambulant Stall</button>
            </div>
        </div>
    </div>
</div>

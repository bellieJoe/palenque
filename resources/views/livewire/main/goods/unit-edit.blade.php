<div>
    <x-page-header title="Units" />
    <div class="card" style="max-width: 800px">
        <div class="card-header">
            <h6 class="card-title">Edit Unit</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="mb-2 col">
                    <label for="name" class="form-label">Unit <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" wire:model.live.debounce.300ms="name">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-2 col-12 col-md-6 col-lg-4">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="is_base_unit" wire:model.live.debounce.300ms="is_base_unit" />
                        <label for="is_base_unit" class="form-check-label">Is Base Unit <span class="text-danger">*</span></label>
                    </div>
                    @error('is_base_unit') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                @if (!$is_base_unit)
                    <div class="mb-2 col-12 col-md-6 col-lg-4">
                        <label for="name" class="form-label">Base Unit <span class="text-danger">*</span></label>
                        <select type="text" class="form-control" id="base_unit" wire:model.live.debounce.300ms="base_unit">
                            <option value="">Select Base Unit</option>
                            @foreach ($base_units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                            @endforeach
                        </select>
                        @error('base_unit') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-2 col-12 col-md-6 col-lg-4">
                        <label for="name" class="form-label">Conversion Factor <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="conversion_factor" wire:model.live.debounce.300ms="conversion_factor">
                        @error('conversion_factor') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                @endif
            </div>
            <div class="d-flex justify-content-end ">
                <a type="button" class="btn btn-secondary" href="{{ route('main.units.index') }}" wire:navigate>Cancel</a>
                <button type="button" class="btn btn-primary ml-2" wire:click="updateUnit" wire:loading.attr="disabled">Save Unit</button>
            </div>
        </div>
    </div>
</div>

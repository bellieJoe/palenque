<div>
    <x-page-header title="Price Monitoring" />
    <div class="card" >
        <div class="card-header">
            <h6 class="card-title">Update Item Price</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="mb-2 col-12 col-md-6 col-lg-4">
                    <label for="name" class="form-label">Item <span class="text-danger">*</span></label>
                    <input type="text" class="form-control"value="{{ $item->name }}" disabled>
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-2 col-12 col-md-6 col-lg-4">
                    <label for="name" class="form-label">Unit <span class="text-danger">*</span></label>
                    <select class="form-control" wire:model.live.debounce.300ms="unit">
                        <option value="">-Select Unit-</option>
                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                        @endforeach
                    </select>
                    @error('uni') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-2 col-12 col-md-6 col-lg-4">
                    <label for="name" class="form-label">Price <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text">₱</span>
                        <input type="number" min="0" class="form-control" wire:model.live.debounce.300ms="price">
                    </div>
                    @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-2 col-12 col-md-6 col-lg-4">
                    <label for="name" class="form-label">Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" wire:model.live.debounce.300ms="date">
                    @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="d-flex justify-content-end ">
                <a type="button" class="btn btn-secondary" href="{{ route('main.price-monitoring.index') }}" wire:navigate>Cancel</a>
                <button type="button" class="btn btn-primary ml-2" wire:click="store" wire:loading.attr="disabled">Save Price</button>
            </div>
        </div>
    </div>
</div>

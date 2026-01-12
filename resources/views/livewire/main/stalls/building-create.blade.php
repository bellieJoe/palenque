<div>
    <x-page-header title="Buildings" />
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="mb-2">
                        <label for="">Building Name</label>
                        <input type="text" class="form-control" wire:model.live.debounce.300ms="name">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4 align-self-end">
                    <div class="mb-2">
                       <button class="btn btn-primary" wire:loading.attr="disabled" wire:click="save">Save</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

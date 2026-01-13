<div>
    <x-page-header title="Buildings" />
    <div class="card">
        <div class="card-header">
            <h6 class="card-title">
                <a class="btn btn-sm btn-secondary border-0 mr-2" href="{{ route('main.buildings.index') }}" wire:navigate><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                Edit Building
            </h6>
        </div>
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

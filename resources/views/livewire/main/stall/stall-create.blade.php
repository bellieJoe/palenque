<div class="" >
    <button class="btn btn-primary" wire:click="showCreateStallModal">Add Stall</button>
    <div class="modal fade " id="createStallModal" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createStallModalLabel">Add Stall</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" wire:model.lazy="name">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-2">
                        <label for="name" class="form-label">Location <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" wire:model.lazy="location">
                        @error('location') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-2">
                        <label for="name" class="form-label">Type of Goods Sold <span class="text-danger">*</span></label>
                        <select name="productType" id="" class="form-control" wire:model.lazy="productType">
                            <option value="">-Select Type-</option>
                            <option value="WET">Wet Goods</option>
                            <option value="DRY">Dry Goods</option>
                        </select>
                        @error('productType') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-2">
                        <label for="area" class="form-label">Area(sqm) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="area" wire:model.lazy="area">
                        @error('area') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-2">
                        <label for="name" class="form-label">Stall Rate <span class="text-danger">*</span></label>
                        <select name="" class="form-control select2" wire:model.lazy="stall_rate">
                            <option value="">-Select Rate-</option>
                            @foreach ($stallRates as $stallRate)
                                <option value="{{ $stallRate->id }}">{{ $stallRate->name }} - {{ $stallRate->rate }}</option>
                            @endforeach
                        </select>
                        @error('stall_rate') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-2">
                        <label for="name" class="form-label">Building <span class="text-danger">*</span></label>
                        <select name="" class="form-control select2" wire:model.lazy="building">
                            <option value="">-Select Building-</option>
                            @foreach ($buildings as $building)
                                <option value="{{ $building->id }}">{{ $building->name }}</option>
                            @endforeach
                        </select>
                        @error('building') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" wire:loading.attr="disabled" wire:click="saveStall">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@script
<script>
    $(document).ready(function() {
        $('.select2').select2();
    })
    $wire.on('show-create-stall-modal', () => {
        $('#createStallModal').modal('show');
    });
    $wire.on('hide-create-stall-modal', () => {
        $('#createStallModal').modal('hide');
    });
</script>
@endscript

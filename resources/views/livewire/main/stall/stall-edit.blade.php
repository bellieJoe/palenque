<div class="" >
    <div class="modal fade " id="editStallModal" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStallModalLabel">Edit Stall</h5>
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
                        <label for="area" class="form-label">Area (sqm) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="area" wire:model.lazy="area">
                        @error('area') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-2">
                        <label for="name" class="form-label">Rate <span class="text-danger">*</span></label>
                        <select name="" class="form-control select2" wire:model.lazy="stall_rate">
                            <option value="">-Select Rate-</option>
                            @foreach ($stallRates as $stallRate)
                                <option value="{{ $stallRate->id }}">{{ $stallRate->name }} - {{ $stallRate->rate }}</option>
                            @endforeach
                        </select>
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" wire:loading.attr="disabled" wire:click="updateStall">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@script
<script>
    $wire.on('show-edit-stall-modal', () => {
        $('#editStallModal').modal('show');
    });
    $wire.on('hide-edit-stall-modal', () => {
        $('#editStallModal').modal('hide');
    });
</script>
@endscript

<div class="" >
    <div class="modal fade " id="editStallRateModal" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStallRateModalLabel">Edit Stall Rate</h5>
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
                        <label for="code" class="form-label">Code <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="code" wire:model.lazy="code">
                        @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-2">
                        <label for="rate" class="form-label">Rate <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="rate" wire:model.lazy="rate">
                        @error('rate') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" wire:loading.attr="disabled" wire:click="updateStallRate">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@script
<script>
    $wire.on('show-edit-stall-rate-modal', () => {
        $('#editStallRateModal').modal('show');
    });
    $wire.on('hide-edit-stall-rate-modal', () => {
        $('#editStallRateModal').modal('hide');
    });
</script>
@endscript

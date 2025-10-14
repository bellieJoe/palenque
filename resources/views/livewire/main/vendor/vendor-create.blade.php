<div class="" >
    <button class="btn btn-primary" wire:click="showCreateVendorModal">Register Vendor</button>
    <div class="modal fade " id="createVendorModal" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createVendorModalLabel">Register Vendor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" wire:model.live.debounce.300ms="name">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-2">
                        <label for="representative_name" class="form-label">Representative <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="representative_name" wire:model.live.debounce.300ms="representative_name">
                        @error('representative_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-2">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="email" wire:model..live.debounce.300ms="email">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-2">
                        <label for="contact_number" class="form-label">Contact Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="contact_number" wire:model.live.debounce.300ms="contact_number">
                        @error('contact_number') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" wire:loading.attr="disabled" wire:click="saveVendor">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>
@script
<script>
    $wire.on('show-create-vendor-modal', () => {
        $('#createVendorModal').modal('show');
    });
    $wire.on('hide-create-vendor-modal', () => {
        $('#createVendorModal').modal('hide');
    });
</script>
@endscript

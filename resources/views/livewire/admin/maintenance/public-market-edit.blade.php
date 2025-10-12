
<div class="" >
    {{-- <button class="btn btn-primary" wire:click="showEditRoleModal">Add User</button> --}}
    <div class="modal fade " id="editPublicMarketModal" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPublicMarketLabel">Edit Public Market</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name"  value="{{ $name }}" wire:model.lazy="name">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-2">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address"  value="{{ $address }}" wire:model.lazy="address">
                        @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" wire:loading.attr="disabled" wire:click="updateMarket">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@script
<script>
    $wire.on('show-edit-public-market-modal', () => {
        $('#editPublicMarketModal').modal('show');
    });
    $wire.on('hide-edit-public-market-modal', () => {
        $('#editPublicMarketModal').modal('hide');
    });
</script>
@endscript

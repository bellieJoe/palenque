<div class="" >
    <button class="btn btn-primary" wire:click="showCreateItemCategoryModal">Add Item Category</button>
    <div class="modal fade " id="createItemCategoryModal" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createItemCategoryModalLabel">Add Item Category</h5>
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
                        <label for="is_fish" class="form-label">Is Fish <span class="text-danger">*</span></label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_fish" wire:model.lazy="is_fish">
                            <label class="form-check-label" for="is_fish">Is Fish</label>
                        </div>
                        @error('is_fish') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" wire:loading.attr="disabled" wire:click="saveItemCategory">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@script
<script>
    $wire.on('show-create-item-category-modal', () => {
        $('#createItemCategoryModal').modal('show');
    });
    $wire.on('hide-create-item-category-modal', () => {
        $('#createItemCategoryModal').modal('hide');
    });
</script>
@endscript

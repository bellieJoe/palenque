<div class="" >
    <div class="modal fade " id="editGoodsModal" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGoodsModalLabel">Edit Item</h5>
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
                        <label for="name" class="form-label">Category <span class="text-danger">*</span></label>
                        <select name="category" id="category" class="form-control" wire:model.lazy="category">
                            <option value="">-Select Category-</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-2">
                        <label for="name" class="form-label">Type <span class="text-danger">*</span></label>
                        <select name="type" id="type" class="form-control" wire:model.lazy="type">
                            <option value="">-Select Type-</option>
                            <option value="WET">Wet Goods</option>
                            <option value="DRY">Dry Goods</option>
                        </select>
                        @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-2">
                        <label for="name" class="form-label">Default Unit <span class="text-danger">*</span></label>
                        <select name="defaultUnit" id="type" class="form-control" wire:model.lazy="defaultUnit">
                            <option value="">-Select Unit-</option>
                            @foreach ($units as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('defaultUnit') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" wire:loading.attr="disabled" wire:click="updateItem">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@script
<script>
    $wire.on('show-edit-goods-modal', () => {
        $('#editGoodsModal').modal('show');
    });
    $wire.on('hide-edit-goods-modal', () => {
        $('#editGoodsModal').modal('hide');
    });
</script>
@endscript

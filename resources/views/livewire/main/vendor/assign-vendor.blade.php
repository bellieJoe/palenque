<div class="" >
    
    <div class="modal fade " id="assignStallModal" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignStallModalLabel">Create Contract</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4 mb-2">
                            <div class="border-2 p-2">
                                <label class="small mb-0 text-muted">Vendor</label>
                                <div>{{ $vendor ? $vendor->name : '' }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="stall" class="form-label">Stall <span class="text-danger">*</span></label>
                        {{-- <input type="text" class="form-control" id="name" wire:model.live.debounce.300ms="name"> --}}
                        <select name="stall" id="stall" class="form-control" wire:model.lazy="stall">
                            <option value="">-Select Stall-</option>
                            @foreach ($stalls as $stall)
                                <option value="{{ $stall->id}}">{{ $stall->name }}</option>
                            @endforeach
                        </select>
                        @error('stall') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <label for="start_date" class="form-label">Contract Duration</label>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-2">
                                <label for="start_date" class="form-label">Start <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="start_date" wire:model.live.debounce.300ms="start_date">
                                @error('start_date') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2">
                                <label for="end_date" class="form-label">End <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="end_date" wire:model.live.debounce.300ms="end_date">
                                @error('end_date') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" wire:loading.attr="disabled" wire:click="assign">Assign</button>
                </div>
            </form>
        </div>
    </div>
</div>
@script
<script>
    $wire.on('show-assign-stall-modal', () => {
        $('#assignStallModal').modal('show');
    });
    $wire.on('hide-assign-stall-modal', () => {
        $('#assignStallModal').modal('hide');
    });
</script>
@endscript

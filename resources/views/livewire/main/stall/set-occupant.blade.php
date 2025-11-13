<div class="" >
    <div class="modal fade " id="setStallOccupantModal" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="setStallOccupantModalLabel">Set Stall Occupant</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-2" >
                        <div class="" wire:ignore>
                            <label for="vendor" class="form-label">Vendor <span class="text-danger">*</span></label>
                            <select name="vendor" id="vendor" class="form-control select2" >
                                <option value="">-Select Vendor-</option>
                                @foreach ($vendors as $vendor)
                                    <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('vendor') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-2">
                        <label for="date_occupied" class="form-label">Date Occupied <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="date_occupied" wire:model.lazy="date_occupied">
                        @error('date_occupied') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" wire:loading.attr="disabled" wire:click="saveStallOccupant">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@script
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#setStallOccupantModal .select2').select2({
                theme: 'bootstrap4',
                dropdownParent: $('#setStallOccupantModal'),
                width: '100%'
            })
            .on('change', function (e) {
                // manually update Livewire property
                console.log($(this).val());
                @this.set('vendor', $(this).val());
            })
            .next('.select2-container').addClass('form-control');
            
        })
    </script>
@endsection()

<script>
    $wire.on('show-set-stall-occupant-modal', () => {
        $('#setStallOccupantModal').modal('show');
    });
    $wire.on('hide-set-stall-occupant-modal', () => {
        $('#setStallOccupantModal').modal('hide');
    });
</script>
@endscript

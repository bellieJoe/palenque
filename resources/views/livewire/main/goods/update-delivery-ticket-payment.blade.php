<div class="" >
    <div class="modal fade " id="updateDeliveryPaymentModal" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Update Delivery Ticket Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="receipt_no" class="form-label">Receipt No <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="receipt_no" wire:model.lazy="receipt_no">
                        @error('receipt_no') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-2">
                        <label for="date_paid" class="form-label">Date Paid <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="date_paid" wire:model.lazy="date_paid">
                        @error('date_paid') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" wire:loading.attr="disabled" wire:click="updatePayment">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@script
<script>
    $wire.on('show-update-delivery-payment-modal', () => {
        $('#updateDeliveryPaymentModal').modal('show');
    });
    $wire.on('hide-update-delivery-payment-modal', () => {
        $('#updateDeliveryPaymentModal').modal('hide');
    });
</script>
@endscript

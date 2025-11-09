<div>
    <x-page-header title="Deliveries" />
    <div class="card" >
        <div class="card-header">
            <h6 class="card-title">Add Delivery</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="mb-2 col col-lg-4">
                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" wire:model.live.debounce.300ms="name">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-2 col col-lg-4">
                    <label for="date_delivered" class="form-label">Date Delivered <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="date_delivered" wire:model.live.debounce.300ms="date_delivered">
                    @error('date_delivered') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-2 col col-lg-4" >
                    <label for="supplier" class="form-label">Supplier <span class="text-danger">*</span></label>
                    <select 
                    class="form-control " 
                    id="supplier" 
                    wire:model.lazy="supplier">
                        <option value="">-Select Supplier-</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                    @error('supplier') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <br>
            <h6>Wet & Dry Goods Items</h6>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Unit</th>
                            <th>Quantity</th>
                            <th>Tax</th>
                            <th>Ticket No.</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $key => $item)
                            <tr>
                                <td class="align-middle" >
                                    <select name="" id="" class="form-control " wire:model.defer="items.{{ $key }}.item_id">
                                        <option value="">-Select Item-</option>
                                        @foreach ($itemOptions->whereNotIn('id', collect($items)->pluck('item_id')) as $itemOption)
                                            <option value="{{ $itemOption->id }}">{{ $itemOption->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="align-middle">
                                    <select name="" id="" class="form-control " wire:model.defer="items.{{ $key }}.unit_id">
                                        <option value="">-Select Unit-</option>
                                        @foreach ($unitOptions as $unitOption)
                                            <option value="{{ $unitOption->id }}">{{ $unitOption->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="align-middle">
                                    <input type="number" class="form-control" wire:model.live.debounce.300ms="items.{{ $key }}.amount">
                                </td>
                                <td class="align-middle">
                                    <input type="number" class="form-control" wire:model.live.debounce.300ms="items.{{ $key }}.tax">
                                </td>
                                <td class="align-middle">
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="items.{{ $key }}.ticket_no">
                                </td>
                                <td class="align-middle">
                                    <button class="btn btn-outline-danger" wire:click="removeItem({{ $key }})">Remove</button>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="6">
                                <button class="btn btn-outline-success w-100" wire:click="addItem">Add Item</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end ">
                <a type="button" class="btn btn-secondary" href="{{ route('main.deliveries.index') }}" wire:navigate>Cancel</a>
                <button type="button" class="btn btn-primary ml-2" wire:click="storeDelivery" wire:loading.attr="disabled">Save Delivery</button>
            </div>
        </div>
    </div>
</div>
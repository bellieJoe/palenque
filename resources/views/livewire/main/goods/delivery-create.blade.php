<div>
    <x-page-header title="Deliveries" />
    <div class="card" >
        <div class="card-header">
            <h6 class="card-title">Add Delivery</h6>
        </div>
        <div class="card-body">
            <div class="row">
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
                <table class="table" style="min-width: 1200px">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Item <span class="text-danger">*</span></th>
                            <th>Category <span class="text-danger">*</span></th>
                            <th>Unit <span class="text-danger">*</span></th>
                            <th>Origin <span class="text-danger">*</span></th>
                            <th>Quantity <span class="text-danger">*</span></th>
                            <th>Tax(Php) <span class="text-danger">*</span></th>
                            <th>Ticket No. <span class="text-danger">*</span></th>
                            <th>Ticket Status <span class="text-danger">*</span></th>
                            {{-- <th>Receipt No.</th> --}}
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $key => $item)
                            <tr>
                                <td class="align-middle" >
                                    @if ($items[$key]['item_id'])
                                        {{\App\Models\Item::find($items[$key]['item_id'])->type}}
                                    @endif
                                </td>
                                <td class="align-middle" >
                                    <select name="" id="" class="form-control " wire:model.live="items.{{ $key }}.item_id" wire:change="setUnit({{ $key }})" >
                                        <option value="">-Select Item-</option>
                                        @foreach ($itemOptions->whereNotIn('id', collect($items)->except($key)->pluck('item_id')) as $itemOption)
                                            <option value="{{ $itemOption->id }}">{{ $itemOption->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('items.'.$key.'.item_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                                <td>
                                    @if ($items[$key]['item_id'])
                                        {{\App\Models\Item::find($items[$key]['item_id'])->itemCategory->name}}
                                    @endif
                                </td>
                                <td class="align-middle">
                                    @if ($items[$key]['item_id'])
                                    <select name="" id="" class="form-control " wire:model.live="items.{{ $key }}.unit_id" wire:change="setTax({{ $key }})">
                                        <option value="">-Select Unit-</option>
                                        @foreach (\App\Models\Item::find($items[$key]['item_id'])->units as $unitOption)
                                            <option value="{{ $unitOption->id }}">{{ $unitOption->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('items.'.$key.'.unit_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="items.{{ $key }}.origin" >
                                    @error('items.'.$key.'.origin') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                                <td class="align-middle">
                                    <input type="number" class="form-control" wire:model.live.debounce.300ms="items.{{ $key }}.amount" wire:change="setTax({{ $key }})">
                                    @error('items.'.$key.'.amount') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                                {{-- <td class="align-middle">
                                    <input type="number" class="form-control" wire:model.live.debounce.300ms="items.{{ $key }}.sales" wire:change="setTax({{ $key }})">
                                    @error('items.'.$key.'.sales') <span class="text-danger">{{ $message }}</span> @enderror
                                </td> --}} 
                                <td class="align-middle">
                                    <input type="number" class="form-control" wire:model.live.debounce.300ms="items.{{ $key }}.tax" wire:change="calculateTotalTax()">
                                    @error('items.'.$key.'.tax') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                                
                                <td class="align-middle">
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="items.{{ $key }}.ticket_no">
                                    @error('items.'.$key.'.ticket_no') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                                <td class="align-middle">
                                    <select name="" id="" class="form-control " wire:model.live="items.{{ $key }}.ticket_status">
                                        <option value="">-Select Ticket Status-</option>
                                        <option value="PAID">PAID</option>
                                        <option value="UNPAID">UNPAID</option>
                                        <option value="WAIVED">WAIVED</option>
                                    </select>
                                    @error('items.'.$key.'.ticket_status') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                                {{-- <td class="align-middle">
                                    <input name="" id="" class="form-control " wire:model.live="items.{{ $key }}.receipt_no" {{ $items[$key]['ticket_status'] == 'PAID' ? '' : 'disabled' }}>
                                    @error('items.'.$key.'.receipt_no') <span class="text-danger">{{ $message }}</span> @enderror
                                </td> --}}
                                <td class="align-middle">
                                    <button class="btn btn-outline-danger" wire:click="removeItem({{ $key }})">Remove</button>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="10">
                                <h6 class="text-right">Total Tax: {{ $total_tax }}</h6>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="10">
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
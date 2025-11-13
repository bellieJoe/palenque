<div>
    <x-page-header title="Fees" />
    <div class="card">
        <div class="card-header">
            <h6 class="card-title">Create Ticket/Fee</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="mb-2 col col-lg-4 col-md-6">
                    <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                    <select type="text" class="form-control" id="type" wire:model.live.debounce.300ms="type">
                        <option value="">Select Type</option>
                        <option value="SUPPLIER">Market Fee</option>
                        <option value="STALL">Stall Collection</option>
                    </select>
                    @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                @if ($type == 'STALL')
                <div class="mb-2 col col-lg-4 col-md-6 position-relative">
                    <label for="type" class="form-label">Select Stall <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="stallSearch" wire:model.live.debounce.300ms="stallSearch" placeholder="Search Stall">
                    @if (!empty($stallOptions))
                        <ul id="suggestions" autocomplete="off" class="list-group position-absolute w-100" style="z-index:1000;">
                            @foreach ($stallOptions as $item)
                                <li class="list-group-item list-group-item-action" wire:click="selectStallOccupant('{{ $item['id'] }}', '{{ $item['name'] }}')">
                                    {{ $item['name'] }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    @error('owner') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                @endif
                @if ($type == 'SUPPLIER')
                <div class="mb-2 col col-lg-4 col-md-6 position-relative">
                    <label for="type" class="form-label">Select Supplier <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="stallSearch" wire:model.live.debounce.300ms="supplierSearch" placeholder="Search Supplier">
                    @if (!empty($supplierOptions))
                        <ul id="suggestions" autocomplete="off" class="list-group position-absolute w-100" style="z-index:1000;">
                            @foreach ($supplierOptions as $item)
                                <li class="list-group-item list-group-item-action" wire:click="selectSupplier('{{ $item['id'] }}', '{{ $item['name'] }}')">
                                    {{ $item['name'] }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    @error('owner') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                @endif
                <div class="mb-2 col col-lg-4 col-md-6">
                    <label for="amount" class="form-label">Amount (Php) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="amount" wire:model.live.debounce.300ms="amount">
                    @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="d-flex justify-content-end ">
                <a type="button" class="btn btn-secondary" href="{{ route('main.fees.index') }}" wire:navigate>Cancel</a>
                <button type="button" class="btn btn-primary ml-2" wire:click="saveFee"  wire:loading.attr="disabled">Save Ticket/Fee</button>
            </div>
        </div>
    </div>
</div>

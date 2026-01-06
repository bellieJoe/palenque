<div>
    <x-page-header title="Wet & Dry Goods Items" />
    <div class="card">
        <div class="card-header">
            <a class="btn btn-sm btn-secondary" wire:navigate href="{{ route("main.goods.index") }}">Back</a> &nbsp;&nbsp;&nbsp;
            @if ($item)
                {{ $item->name }} tax rates
            @endif
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end mb-2 ">
                 &nbsp;
                <button class="btn btn-primary" wire:click="showAddTaxModal">Add</button>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Unit</th>
                            <th scope="col">Rate</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rates as $rate)
                            <tr>
                                <td>{{ $rate->unit->name }}</td>
                                <td>PHP {{ $rate->tax_rate }}</td>
                                <td>
                                    <button class="btn btn-danger" wire:click="deleteRate({{$rate->id}})" wire:confirm="Are you sure you want to delete this tax rate?">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">No Tax Rates Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div wire:ignore class="modal fade" id="addTaxModal" wire:ignore.self tabindex="-1" aria-labelledby="addTaxModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editItemTaxRateModalLabel">Edit Item Tax Rate</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="saveItemTaxRate">
                        <div class="mb-2">
                            <label for="name" class="form-label">Unit <span class="text-danger">*</span></label>
                            <select type="text" class="form-control" id="unit" wire:model.lazy="unit">
                                <option value="">-Select Unit-</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                @endforeach
                            </select>
                            @error('unit') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-2">
                            <label for="rate" class="form-label">Rate (PHP) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="rate" wire:model.lazy="rate">
                            @error('rate') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@script
<script>
    $wire.on('show-add-tax-modal', () => {
        $('#addTaxModal').modal('show');
    });
    $wire.on('hide-add-tax-modal', () => {
        $('#addTaxModal').modal('hide');
    });
</script>
@endscript

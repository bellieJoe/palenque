<div>
    <x-page-header title="Price Monitoring" />

    <div class="row mb-3 justify-content-end">
        <div class=" col col-md-6 col-lg-4">
            <input
                type="date"
                class="form-control"
                wire:model.live.debounce.300ms="date"
            >
        </div>
        <div class=" col col-md-6 col-lg-4">
            <input
                type="text"
                class="form-control"
                placeholder="Search Item"
                wire:model.live.debounce.300ms="search"
            >
        </div>
    </div>

    {{-- WET GOODS --}}
    <div class="card mb-3">
        <div class="card-header">
            <h6 class="card-title mb-0">Wet Goods</h6>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th width="200">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($wetGoods as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">PHP</span>
                                    </div>
                                    <input
                                        type="number"
                                        class="form-control"
                                        wire:model.live.debounce.500ms="items.{{ $item->id }}"
                                    >
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">No items found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- DRY GOODS --}}
    <div class="card mb-3">
        <div class="card-header">
            <h6 class="card-title mb-0">Dry Goods</h6>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th width="200">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dryGoods as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">PHP</span>
                                    </div>
                                    <input
                                        type="number"
                                        class="form-control"
                                        wire:model.live.debounce.500ms="items.{{ $item->id }}"
                                    >
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">No items found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div>
    @livewire('main.goods.goods-edit')
    <x-page-header title="Wet & Dry Goods Items" />
    <div class="d-flex justify-content-end mb-2">
        @livewire('main.goods.goods-create')
    </div>
    <div class="card">
        <div class="card-body">
            <div class="mb-2">
                <input type="text" class="form-control mb-3" wire:model.live.debounce.300ms="search" placeholder="Search Items...">
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th>Unit</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->itemCategory->name }}</td>
                                <td>{{ $item->type }}</td>
                                <td>{{ $item->defaultUnit->name }}</td>
                                <td>
                                    <button class="btn btn-outline-danger" wire:click="deleteItem({{$item->id}})" wire:confirm="Are you sure you want to delete this item?">Delete</button>
                                    <button class="btn btn-outline-primary" wire:click="editItem({{$item->id}})">Edit</button>
                                    <a class="btn btn-outline-primary" href="{{ route('main.goods.edit-tax-rate', $item->id) }}" wire:navigate>Edit Tax Rates</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center">No Items Found</td></tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $items->links() }}
            </div>
        </div>
    </div>
</div>

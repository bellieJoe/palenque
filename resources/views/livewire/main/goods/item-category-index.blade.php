<div>
    @livewire('main.goods.item-category-edit')
    <x-page-header title="Item Categories" />
    <div class="d-flex justify-content-end mb-2">
        @livewire('main.goods.item-category-create')
    </div>
    <div class="card">
        <div class="card-body">
            <input type="text" class="form-control mb-3" wire:model.live.debounce.300ms="search" placeholder="Search Categories...">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th>Name</th>
                        <th>Is Fish</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->is_fish ? 'Yes' : 'No' }}</td>
                                <td>
                                    <button class="btn btn-outline-danger" wire:click="deleteCategory({{$category->id}})" wire:confirm="Are you sure you want to delete this category?">Delete</button>
                                    <button class="btn btn-outline-primary" wire:click="editCategory({{$category->id}})">Edit</button>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="2" class="text-center">No Categories Found</td></tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>

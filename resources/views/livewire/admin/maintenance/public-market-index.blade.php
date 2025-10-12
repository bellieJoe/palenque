<div>
    @livewire('admin.maintenance.public-market-edit')
    <div class="d-flex justify-content-end mb-2">
        @livewire('admin.maintenance.public-market-create')
    </div>
    <div class="card">
        <div class="card-body">
            <input type="text" class="form-control" wire:model.live.debounce.300ms="search" placeholder="Search...">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        <tbody>
                            @foreach ($publicMarkets as $publicMarket)
                                <tr>
                                    <td>{{ $publicMarket->name }}</td>
                                    <td>{{ $publicMarket->address }}</td>
                                    <td>
                                        <button class="btn btn-outline-danger" wire:click="deletePublicMarket({{ $publicMarket->id }})" wire:confirm="Are you sure you want to delete this public market?">
                                            Delete
                                        </button>
                                        <button class="btn btn-outline-primary" wire:click="editPublicMarket({{ $publicMarket->id }})" >
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </tbody>
                </table>
                {{ $publicMarkets->links() }}
            </div>
        </div>
    </div>
</div>

<div>
    <x-page-header title="Wet & Dry Goods Deliveries" />
    <div class="d-flex justify-content-end mb-3">
        <a class="btn btn-primary" href="{{ route('main.deliveries.create') }}" wire:navigate>Add Delivery</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <div class="row">
                    <div class="col">
                        <div class="input-group" style="min-width: 300px">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Start Date</span>
                            </div>
                            <input type="date" class="form-control " wire:model.live.debounce.300ms="fromFilter" placeholder="From">
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group" style="min-width: 300px">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">End Date</span>
                            </div>
                            <input type="date" class="form-control" wire:model.live.debounce.300ms="toFilter" placeholder="To">
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hovered" style="min-width: 1000px">
                    <thead>
                        <th>Suppler</th>
                        <th>Date Delivered</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @forelse ($deliveries as $delivery)
                            <tr>
                                <td class="align-middle">{{ $delivery->supplier->name }}</td>
                                <td class="align-middle">{{ $delivery->supplier->name }}</td>
                                <td class="align-middle">
                                    {{-- <button class="btn btn-outline-danger" wire:click="deleteUnit('{{ $unit->id }}')" wire:confirm="Are you sure you want to delete this unit? This action is irreversible.">Delete Unit</button>
                                    <a class="btn btn-outline-primary" href="{{ route('main.units.edit', $unit->id) }}" wire:navigate>Edit Unit</a> --}}
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center">No Deliveries Found</td></tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $deliveries->links() }}
            </div>
        </div>
    </div>
</div>

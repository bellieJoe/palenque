<div>
    <x-page-header title="Units/Measurement" />
    <div class="d-flex justify-content-end mb-3">
        <a class="btn btn-primary" href="{{ route('main.units.create') }}">Add Unit</a>
    </div>
    <div class="card">
        <div class="card-body">
            <input type="text" class="form-control mb-3" wire:model.live.debounce.300ms="search" placeholder="Search Unit...">
            <div class="table-responsive">
                <table class="table table-hovered" style="min-width: 1000px">
                    <thead>
                        <th>Unit Name</th>
                        <th>Base Unit</th>
                        <th>Conversion Factor</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @forelse ($units as $unit)
                            <tr>
                                <td class="align-middle">{{ $unit->name }}</td>
                                <td class="align-middle">{{ $unit->is_base_unit ? 'N/A' : $unit->baseUnit->name }}</td>
                                <td class="align-middle">{{ $unit->is_base_unit ? 'N/A' : $unit->conversion_factor }}</td>
                                <td class="align-middle">
                                    @if (!$unit->trashed())
                                        <button class="btn btn-outline-danger" wire:click="deleteUnit('{{ $unit->id }}')" wire:confirm="Are you sure you want to delete this unit? ">Delete Unit</button>
                                        <a class="btn btn-outline-primary" href="{{ route('main.units.edit', $unit->id) }}" wire:navigate>Edit Unit</a>
                                    @endif
                                    @if($unit->trashed())
                                        <button class="btn btn-outline-danger" wire:click="restoreUnit('{{ $unit->id }}')" wire:confirm="Are you sure you want to restore this unit? ">Restore Unit ({{ number_format(now()->diffInDays($unit->restore_date), 0) }} days left)</button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center">No Units Found</td></tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $units->links() }}
            </div>
        </div>
    </div>
</div>

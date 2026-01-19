<div>
    @livewire('main.stall.stall-rate-update')
    <x-page-header title="Stall Rates" />
    <div class="d-flex justify-content-end mb-2">
        @livewire('main.stall.stall-rate-create')
    </div>
    <div class="card">
        <div class="card-body">
            <input wire:model.live.debounce.300ms="search" type="text" class="form-control mb-3" placeholder="Search Stall Rates...">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="">
                        <tr>
                            <th>Name</th>
                            {{-- <th>Code</th> --}}
                            <th>Rate</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($stallRates as $stallRate)
                            <tr>    
                                <td>{{ $stallRate->name }}</td>
                                {{-- <td>{{ $stallRate->code }}</td> --}}
                                <td>{{ $stallRate->rate }}</td>
                                <td>
                                    <!-- Example actions -->
                                    @if (!$stallRate->trashed())
                                        <button class="btn btn-outline-danger" wire:click="deleteStallRate({{$stallRate->id}})" wire:confirm="Are you sure you want to delete this stall Rate?">Delete</button>
                                        <button class="btn btn-outline-primary" wire:click="editStallRate({{$stallRate->id}})">Edit</button>
                                    @endif
                                    @if ($stallRate->trashed())
                                        <button class="btn btn-outline-danger" wire:click="restoreStallRate({{$stallRate->id}})" wire:confirm="Are you sure you want to restore this stall Rate?">Restore ({{ number_format(now()->diffInDays($stallRate->restore_date), 0) }} days left)</button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No stall rates found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination links -->
            <div class="d-flex justify-content-center mt-3">
                {{ $stallRates->links() }}
            </div>
        </div>
    </div>
</div>

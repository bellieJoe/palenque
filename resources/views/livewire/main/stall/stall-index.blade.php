<div>
    @livewire('main.stall.stall-edit')
    @livewire('main.stall.set-occupant')
    <x-page-header title="Stalls" />
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-7">
                            <i class="fa-solid fa-store font-20 text-purple"></i>
                            <p class="font-16 m-b-5">Total Stalls</p>
                        </div>
                        <div class="col-5">
                            <h1 class="font-light text-right mb-0">{{ $counts["total_stalls"] }}</h1>
                        </div>
                    </div>
                </div>
            </div>                        
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-7">
                            <i class="fa-solid fa-store font-20 text-danger"></i>
                            <p class="font-16 m-b-5">Available Stalls</p>
                        </div>
                        <div class="col-5">
                            <h1 class="font-light text-right mb-0">{{ $counts["available_stalls"] }}</h1>
                        </div>
                    </div>
                </div>
            </div>                        
        </div>
    </div>
    <div class="d-flex justify-content-end mb-2">
        @livewire('main.stall.stall-create')
    </div>
    <div class="card">
        <div class="card-body">
            <input type="text" class="form-control mb-3" wire:model.live.debounce.300ms="search" placeholder="Search Stalls...">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th>Name</th>
                        <th>Area</th>
                        <th>Rate</th>
                        <th>Occupancy Status</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @forelse ($stalls as $stall)
                            <tr>
                                <td>{{ $stall->name }}</td>
                                <td>{{ $stall->area }} sqm</td>
                                <td>Php {{ number_format($stall->stallRate->rate, 2, '.', ',')}}</td>
                                <td>
                                    @if ($stall->activeOccupant)
                                        <span class="badge badge-success">Occupied</span> by {{ $stall->activeOccupant->vendor->name }}
                                    @else
                                        {{-- <button class="btn btn-outline-success" wire:click="setOccupant({{$stall->id}})">Set Occupant</button> --}}
                                        <span class="badge badge-secondary">Vacant</span>
                                    @endif
                                </td>
                                <td>
                                    @if (!$stall->trashed())
                                        <button class="btn btn-outline-danger" wire:click="deleteStall({{$stall->id}})" wire:confirm="Are you sure you want to delete this post?">Delete</button>
                                        <button class="btn btn-outline-primary" wire:click="editStall({{$stall->id}})">Edit</button>
                                    @endif
                                    @if ($stall->trashed())
                                        <button class="btn btn-outline-danger" wire:click="restoreStall({{$stall->id}})" wire:confirm="Are you sure you want to restore this post?">Restore ({{ number_format(now()->diffInDays($stall->restore_date), 0) }} days left)</button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="2" class="text-center">No Stalls Found</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

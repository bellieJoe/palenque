<div>
    <x-page-header title="Price Monitoring" />
    @livewire('main.goods.price-history-chart')
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs mb-2">
                <li class="nav-item">
                    <a class="nav-link {{ request()->get('status') == 'approve' ? '' : 'active' }}" href="?status=update">Update Prices</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->get('status') == 'approve' ? 'active' : '' }}" href="?status=approve" >Approve Prices</a>
                </li>
            </ul>
            @if (request()->get('status') != 'approve')
                <div class="">
                    <input type="text" class="form-control mb-3" wire:model.live.debounce.300ms="search" placeholder="Search Items...">
                    <div class="table-responsive">
                        <table class="table table-hovered table-bordered" style="min-width: 1000px">
                            <thead class="thead-light">
                                <th>Latest Min Price</th>
                                <th>Latest Max Price</th>
                                <th>Date Updated</th>
                                {{-- <th>Per Unit</th> --}}
                            </thead>
                            <tbody>
                                @forelse ($items as $item)
                                    <tr class="bg-light">
                                        <th colspan="4" >
                                            <a class="btn btn-sm btn-outline-primary mr-2" href="{{ route('main.price-monitoring.edit', $item->id) }}" wire:navigate>Update Price</a>
                                            {{ $item->name }}
                                        </th>
                                    </tr>
                                    @forelse ($item->updatedPrices as $price)
                                    <tr>
                                        <td>{{ $price ? 'PHP ' . number_format($price->price, 2, '.', ',') : 'Not Set' }}</td>
                                        <td>{{ $price ? 'PHP ' . number_format($price->price_max, 2, '.', ',') : 'Not Set' }}</td>
                                        <td>{{ $price ? $price->date->format('F d, Y') : 'Not Set' }}</td>
                                        {{-- <td>{{ $price ? $price->unit->name : 'Not Set' }}</td> --}}
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No Price Set</td>
                                    </tr>
                                    @endforelse
                                @empty
                                    <tr><td colspan="4" class="text-center">No Items Found</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $items->links() }}
                    </div>
                </div>
            @endif
            @if (request()->get('status') == 'approve')
                <table class="table">
                    <thead>
                        <th>Item</th>
                        <th>Vendor</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @forelse ($pendingPrices as $price)
                            <tr>
                                <td>{{ $price->item->name }}</td>
                                <td>{{ $price->vendor->name }}</td>
                                <td>{{ number_format($price->price, 2, '.', ',') }}</td>
                                <td>{{ $price->date->format('F d, Y') }}</td>
                                <td>
                                    <button class="btn btn-primary" wire:click="approve({{ $price->id }})" wire.confirm="Are you sure you want to approve this price?" >Approve</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">No Pending Vendor Prices</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>

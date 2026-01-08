<div>
    <x-page-header title="Price Monitoring" />
    {{-- <div class="d-flex justify-content-end mb-3">
        <a class="btn btn-primary" href="{{ route('main.price-monitoring.create') }}">Update Price</a>
    </div> --}}
    <div class="card">
        <div class="card-body">
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
    </div>
</div>

<div>
    <div class="card">
        <div class="card-header">
            <h6 class="card-title">Fish Supply</h6>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="">
                        <label for="">Start Date</label>
                        <input type="date" class="form-control" wire:model.live="startFilter">
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="">
                        <label for="">End Date</label>
                        <input type="date" class="form-control" wire:model.live="endFilter">
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Fish</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Origin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td></td>
                            </tr>
                        @empty
                            <tr><td colspan="2" class="text-center">No Items Found</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div>
    <x-page-header title="Ambulant Fee Settings" />
    <div class="card">
        <div class="card-body">
            <form wire:submit.prevent="saveSettings" class="mb-4">
                <label for="daily_fee_amount">Update Daily Fee</label>
                <div class="row w-100">
                    <div class="form-group">
                        <input type="number" step="0.01" class="form-control" id="daily_fee_amount" wire:model.defer="daily_fee_amount" required>
                        @error('daily_fee_amount') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date Applied</th>
                            <th>Value</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($fees as $setting)
                            <tr>
                                <td>{{ $setting->created_at->format('F d, Y') }}</td>
                                <td>Php {{ number_format($setting->rate, 2, '.', ',') }}</td>
                                <td>
                                    @if($setting->is_active)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-secondary">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">No Settings Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $fees->links() }}
            </div>
        </div>
    </div>
</div>

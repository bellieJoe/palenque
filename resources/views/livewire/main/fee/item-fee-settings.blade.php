<div>
    <x-page-header title="Wet & Dry Goods Tax Rate Settings" />
    <div class="card">
        <div class="card-body">
            <form wire:submit.prevent="saveSettings" class="mb-4">
                <label for="daily_fee_amount">Update Tax Rate Percentage</label>
                <div class="row w-100">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="number" step="0.01" class="form-control" id="tax_rate_percentage" wire:model.defer="tax_rate_percentage" required>
                            <label for="" class="input-group-text">%</label>
                        </div>
                        @error('tax_rate_percentage') <span class="text-danger">{{ $message }}</span> @enderror
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
                            <th>Tax Rate Percentage</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($fees as $setting)
                            <tr>
                                <td>{{ $setting->created_at->format('F d, Y') }}</td>
                                <td>Php {{ number_format($setting->percentage, 2, '.', ',') }} %</td>
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

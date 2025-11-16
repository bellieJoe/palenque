<div>
    <x-page-header title="Application Settings" />
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="font-weight-bold">Online Payment</h5>
            <div class="mb-3 form-check">
                <input class="form-check-input form-check-input-lg" type="checkbox" value="" id="onlinePayment" {{ $enable_online_payment ? 'checked' : '' }} wire:model.lazy="enable_online_payment">
                <label class="form-check-label" for="onlinePayment">
                    Enable Online Payment
                </label>
            </div>
            @if ($enable_online_payment)
            <div class="mb-3">
                <label for="">Paymongo Secret Key</label>
                <input type="text" class="form-control" wire:model.debounce.300ms="paymongo_secret_key">
                @error('paymongo_secret_key') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            @endif
            @if ($app_settings->paymongo_secret_key != $paymongo_secret_key || $app_settings->enable_online_payment != $enable_online_payment)
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary" wire:click="updateOnlinePayment" wire:loading.attr="disabled">Update</button>
            </div>
            @endif
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="font-weight-bold">Monthly Rent Settings</h5>
            <div class="mb-3">
                <label for="">Rent Surcharge Rate (%)</label>
                <input type="number" class="form-control" wire:model.lazy="rent_surcharge_rate">
                @error('rent_surcharge_rate') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label for="">Rent Surcharge Frequency (Days)</label>
                <input type="number" step="1" class="form-control" wire:model.lazy="rent_surcharge_frequency">
                @error('rent_surcharge_frequency') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label for="">Rent Grace Period (Days)</label>
                <input type="number" step="1" class="form-control" wire:model.lazy="rent_grace_period">
                @error('rent_grace_period') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            @if ($app_settings->rent_surcharge_frequency != $rent_surcharge_frequency || $app_settings->rent_surcharge_rate != $rent_surcharge_rate || $app_settings->rent_grace_period != $rent_grace_period)
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary" wire:click="updateMonthlyRentSettings" wire:loading.attr="disabled">Update</button>
            </div>
            @endif
        </div>
    </div>
</div>
<?php

use App\Livewire\Admin\Maintenance\PublicMarketIndex;
use App\Livewire\Admin\User\UserIndex;
use App\Livewire\Main\Fee\FeesCreate;
use App\Livewire\Main\Fee\FeesIndex;
use App\Livewire\Main\Goods\DeliveryCreate;
use App\Livewire\Main\Goods\DeliveryIndex;
use App\Livewire\Main\Goods\DeliveryView;
use App\Livewire\Main\Goods\GoodsIndex;
use App\Livewire\Main\Goods\ItemCategoryIndex;
use App\Livewire\Main\Goods\UnitCreate;
use App\Livewire\Main\Goods\UnitEdit;
use App\Livewire\Main\Goods\UnitIndex;
use App\Livewire\Main\Stall\AmbulantStallCreate;
use App\Livewire\Main\Stall\AmbulantStallEdit;
use App\Livewire\Main\Stall\AmbulantStallIndex;
use App\Livewire\Main\Stall\DailyCollectionFeeCreate;
use App\Livewire\Main\Stall\DailyCollectionFeeUpdatePayment;
use App\Livewire\Main\Stall\StallIndex;
use App\Livewire\Main\Stall\StallRateIndex;
use App\Livewire\Main\Supplier\SupplierIndex;
use App\Livewire\Main\Vendor\VendorIndex;
use App\Livewire\Main\Vendor\VendorView;
use App\Livewire\Main\Violation\ViolationCreate;
use App\Livewire\Main\Violation\ViolationIndex;
use App\Livewire\Main\Violation\ViolationTypeCreate;
use App\Livewire\Main\Violation\ViolationTypeEdit;
use App\Livewire\Main\Violation\ViolationTypeIndex;
use App\Livewire\Main\Violation\ViolationTypeView;
use App\Livewire\Main\Violation\ViolationView;
use App\Livewire\Settings\Profile\ProfileIndex;
use App\Models\ItemCategory;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

    Route::view('test', 'test.test')
        ->middleware(['auth', 'verified'])
        ->name('test');

Route::group(["prefix" => "admin", "as" => "admin."], function () {
    Route::group(["prefix" => "users", "as" => "users."], function () {
        Route::get('/', UserIndex::class)->middleware(['auth', 'verified'])->name('index');
    });
    Route::group(["prefix" => "municipal-markets", "as" => "municipal-markets."], function () {
        Route::get('/', PublicMarketIndex::class)->middleware(['auth', 'verified'])->name('index');
    });
});

Route::group(["prefix" => "main", "as" => "main."], function () {
    Route::group(["prefix" => "suppliers", "as" => "suppliers."], function () {
        Route::get('/', SupplierIndex::class)->middleware(['auth', 'verified'])->name('index');
    });
    Route::group(["prefix" => "stalls", "as" => "stalls."], function () {
        Route::get('/', StallIndex::class)->middleware(['auth', 'verified'])->name('index');
    });
    Route::group(["prefix" => "vendors", "as" => "vendors."], function () {
        Route::get('/', VendorIndex::class)->middleware(['auth', 'verified'])->name('index');
        Route::get('view/{id}', VendorView::class)->middleware(['auth', 'verified'])->name('view');
    });
    Route::group(["prefix" => "goods", "as" => "goods."], function () {
        Route::get('/', GoodsIndex::class)->middleware(['auth', 'verified'])->name('index');
    });
    Route::group(["prefix" => "item-categories", "as" => "item-categories."], function () {
        Route::get('/', ItemCategoryIndex::class)->middleware(['auth', 'verified'])->name('index');
    });
    Route::group(["prefix" => "stall-rates", "as" => "stall-rates."], function () {
        Route::get('/', StallRateIndex::class)->middleware(['auth', 'verified'])->name('index');
    });
    Route::group(["prefix" => "violations", "as" => "violations."], function () {
        Route::group(["prefix" => "types", "as" => "types."], function () {
            Route::get('/', ViolationTypeIndex::class)->middleware(['auth', 'verified'])->name('index');
            Route::get('/create', ViolationTypeCreate::class)->middleware(['auth', 'verified'])->name('create');
            Route::get('/view/{id}', ViolationTypeView::class)->middleware(['auth', 'verified'])->name('view');
            Route::get('/edit/{id}', ViolationTypeEdit::class)->middleware(['auth', 'verified'])->name('edit');
        });
        Route::get('', ViolationIndex::class)->middleware(['auth', 'verified'])->name('index');
        Route::get('/create/{vendor_id}', ViolationCreate::class)->middleware(['auth', 'verified'])->name('create');
        Route::get('/view/{vendor_id}', ViolationView::class)->middleware(['auth', 'verified'])->name('view');
    });
    Route::group(["prefix" => "fees", "as" => "fees."], function () {
        Route::get('/', FeesIndex::class)->middleware(['auth', 'verified'])->name('index');
        Route::get('/create', FeesCreate::class)->middleware(['auth', 'verified'])->name('create');
        Route::get('/issue-daily-fee/{ambulant_stall_id}', DailyCollectionFeeCreate::class)->middleware(['auth', 'verified'])->name('issue-daily-fee');
        Route::get('/update-daily-fee/{fee_id}', DailyCollectionFeeUpdatePayment::class)->middleware(['auth', 'verified'])->name('update-daily-fee');
    });
    Route::group(["prefix" => "units", "as" => "units."], function () {
        Route::get('/', UnitIndex::class)->middleware(['auth', 'verified'])->name('index');
        Route::get('/create', UnitCreate::class)->middleware(['auth', 'verified'])->name('create');
        Route::get('/edit/{id}', UnitEdit::class)->middleware(['auth', 'verified'])->name('edit');
    });
    Route::group(["prefix" => "deliveries", "as" => "deliveries."], function () {
        Route::get('/', DeliveryIndex::class)->middleware(['auth', 'verified'])->name('index');
        Route::get('/create', DeliveryCreate::class)->middleware(['auth', 'verified'])->name('create');
        Route::get('/view/{delivery_id}', DeliveryView::class)->middleware(['auth', 'verified'])->name('view');
    });

    Route::group(["prefix" => "ambulant-stalls", "as" => "ambulant-stalls."], function () {
        Route::get('/', AmbulantStallIndex::class)->middleware(['auth', 'verified'])->name('index');
        Route::get('/create', AmbulantStallCreate::class)->middleware(['auth', 'verified'])->name('create');
        Route::get('/edit/{id}', AmbulantStallEdit::class)->middleware(['auth', 'verified'])->name('edit');
    });
});

Route::group(["prefix" => "settings", "as" => "settings."], function () {
    Route::get('account-profile', ProfileIndex::class)->name('profile');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

require __DIR__.'/auth.php';

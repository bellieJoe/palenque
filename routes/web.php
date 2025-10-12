<?php

use App\Livewire\Admin\Maintenance\PublicMarketIndex;
use App\Livewire\Admin\User\UserIndex;
use App\Livewire\Main\Stall\StallIndex;
use App\Livewire\Main\Supplier\SupplierIndex;
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

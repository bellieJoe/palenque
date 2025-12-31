<?php

use App\Http\Controllers\AmbulantStallController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\FeeSettingController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemFeeSettingController;
use App\Http\Controllers\MonthlyRentController;
use App\Http\Controllers\StallOccupantController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitController;
use App\Models\AmbulantStall;
use App\Models\Delivery;
use App\Models\ItemFeeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login', [AuthController::class, 'apiLogin']);

Route::prefix("auth")->group(function () {
    Route::get("is-auth", [AuthController::class, "apiIsAuth"]);
    Route::get("user", [AuthController::class, "apiUser"]);
});

Route::prefix("auth")->group(function () {
    Route::get("user", [AuthController::class, "apiUser"]);
    Route::post("logout", [AuthController::class, "apiLogout"]);
})->middleware("auth:sanctum");

Route::prefix('monthly-rents')->group(function () {
    Route::get('/', [MonthlyRentController::class, 'apiIndex']);
    Route::get('/unpaid', [MonthlyRentController::class, 'apiUnpaid']);
    Route::post('/update/{id}', [MonthlyRentController::class, 'updateRent']);
})->middleware('auth:sanctum');

Route::prefix('stall-occupants')->group(function () {
    Route::get('/', [StallOccupantController::class, 'apiIndex']);
})->middleware('auth:sanctum');

Route::prefix('fees')->group(function () {
    Route::get('/', [FeeController::class, 'apiIndex']);
    Route::post('/create-ambulant-stall-fee', [FeeController::class, 'apiCreateAmbulantStallFee']);
    Route::post('/update-ambulant-stall-fee/{id}', [FeeController::class, 'apiUpdateAmbulantStallFee']);
})->middleware('auth:sanctum');

Route::prefix('ambulant-stalls')->group(function () {
    Route::get('/', [AmbulantStallController::class, 'apiIndex']);
})->middleware('auth:sanctum');

Route::prefix('deliveries')->group(function () {
    Route::get('/', [DeliveryController::class, 'apiIndex']);
    Route::post('/store', [DeliveryController::class, 'apiStore']);
    Route::post('/update', [DeliveryController::class, 'apiUpdate']);
})->middleware('auth:sanctum');

Route::prefix('suppliers')->group(function () {
    Route::get('/', [SupplierController::class, 'apiIndex']);
});

Route::prefix('items')->group(function () {
    Route::get('/', [ItemController::class, 'apiIndex']);
})->middleware('auth:sanctum');

Route::prefix('units')->group(function () {

    Route::get('/', [UnitController::class, 'apiIndex']);
})->middleware('auth:sanctum');

Route::prefix('item-fee-settings')->group(function () {
    Route::get('/get-active', [ItemFeeSettingController::class, 'getActive']);
})->middleware('auth:sanctum');

Route::prefix('fee-settings')->group(function () {
    Route::get('/get-active', [FeeSettingController::class, 'apiGetActive']);
})->middleware('auth:sanctum');
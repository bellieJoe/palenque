<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MonthlyRentController;
use App\Http\Controllers\StallOccupantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login', [AuthController::class, 'apiLogin']);


Route::prefix('monthly-rents')->group(function () {
    Route::get('/', [MonthlyRentController::class, 'apiIndex']);
    Route::get('/unpaid', [MonthlyRentController::class, 'apiUnpaid']);
    Route::post('/update/{id}', [MonthlyRentController::class, 'updateRent']);
})->middleware('auth:sanctum');

Route::prefix('stall-occupants')->group(function () {
    Route::get('/', [StallOccupantController::class, 'apiIndex']);
})->middleware('auth:sanctum');
<?php

use App\Http\Controllers\admin\FoodTierController;
use App\Http\Controllers\admin\OffController;
use App\Models\RestaurantTier;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:admin')->name('admin.')->prefix('/admin')->group(function () {
    Route::resources([
        'food' => FoodTierController::class,
        'restaurants' => RestaurantTier::class
    ]);
    Route::resource('offs', OffController::class)->only([
        'index', 'show', 'create', 'store', 'destroy'
    ]);
});

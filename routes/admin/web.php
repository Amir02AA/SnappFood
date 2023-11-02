<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\FoodTierController;
use App\Http\Controllers\admin\OffCodeController;
use App\Http\Controllers\admin\RestaurantTierController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'myAuth:admin'])->name('admin.')->prefix('/admin')->group(function () {
    Route::resources([
        'food' => FoodTierController::class,
        'restaurants' => RestaurantTierController::class
    ]);
    Route::resource('off', OffCodeController::class)->only([
        'index', 'show', 'create', 'store', 'destroy'
    ]);

    Route::get('/panel', [AdminController::class, 'panel'])->name('panel');
});

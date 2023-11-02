<?php

use App\Http\Controllers\SalesMan\FoodController;
use App\Http\Controllers\SalesMan\HomeController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'myAuth:sales'])->name('sales.')->prefix('/sales')->group(function () {
    Route::resource('food', FoodController::class);

    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/settings', [HomeController::class, 'settings'])->name('settings');

    Route::post('/profile', [HomeController::class, 'profileStore'])->name('profile.store');
    Route::post('/settings/{restaurant}', [HomeController::class, 'settingsStore'])->name('settings.store');
});

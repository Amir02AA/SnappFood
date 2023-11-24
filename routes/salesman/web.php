<?php

use App\Http\Controllers\PartyController;
use App\Http\Controllers\salesman\FoodController;
use App\Http\Controllers\salesman\HomeController;
use App\Http\Controllers\salesman\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:sales'])->name('sales.')->prefix('/sales')->group(function () {

    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');

    Route::post('/profile', [HomeController::class, 'profileStore'])->name('profile.store');

    Route::resource('food', FoodController::class);

    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/settings', [HomeController::class, 'settings'])->name('settings');

    Route::post('/settings/{restaurant}', [HomeController::class, 'settingsStore'])->name('settings.store');

    Route::get('food/{food}/party', [PartyController::class, 'create'])->name('party.create');
    Route::post('food/{food}/party', [PartyController::class, 'store'])->name('party.store');
    Route::delete('food/{food}/party', [PartyController::class, 'destroy'])->name('party.destroy');

    Route::get('/{cart}/next', [OrderController::class, 'nextState'])->name('order.next');
//    Route::delete('/{cart}/cancel', [OrderController::class, 'cancel'])->name('order.cancel');

    Route::get('/carts/archive', [OrderController::class, 'archive'])->name('carts.archive');
});
Route::redirect('/sales', 'sales/dashboard');

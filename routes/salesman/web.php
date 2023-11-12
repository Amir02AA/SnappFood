<?php

use App\Http\Controllers\PartyController;
use App\Http\Controllers\salesman\FoodController;
use App\Http\Controllers\salesman\HomeController;
use App\Http\Middleware\SalesGateMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:sales', SalesGateMiddleware::class])->name('sales.')->prefix('/sales')->group(function () {

    Route::get('/profile', [HomeController::class, 'profile'])->name('profile')
        ->withoutMiddleware(SalesGateMiddleware::class);

    Route::post('/profile', [HomeController::class, 'profileStore'])->name('profile.store')
        ->withoutMiddleware(SalesGateMiddleware::class);

    Route::resource('food', FoodController::class);

    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/settings', [HomeController::class, 'settings'])->name('settings');

    Route::post('/settings/{restaurant}', [HomeController::class, 'settingsStore'])->name('settings.store');

    Route::get('food/{food}/party',[PartyController::class,'create'])->name('party.create');
    Route::post('food/{food}/party',[PartyController::class,'store'])->name('party.store');
    Route::delete('food/{food}/party',[PartyController::class,'destroy'])->name('party.destroy');

});
Route::redirect('/sales','sales/dashboard');

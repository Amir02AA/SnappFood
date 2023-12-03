<?php

use App\Http\Controllers\PartyController;
use App\Http\Controllers\salesman\ChartController;
use App\Http\Controllers\salesman\CommentController;
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

    Route::get('/{order}/next', [OrderController::class, 'nextState'])->name('order.next');
    Route::delete('/{order}/cancel', [OrderController::class, 'cancel'])->name('order.cancel');

    Route::get('/orders/archive', [OrderController::class, 'archive'])->name('orders.archive');

    Route::get('/orders/{order}',[OrderController::class,'show'])->name('orders.show');
    Route::get('/orders/charts',[ChartController::class,'index'])->name('orders.charts');

    Route::controller(CommentController::class)->group(function (){
        Route::get('/comment', 'index')->name('comment.index');
        Route::post('/comment/{comment}/reply', 'reply')->name('comment.reply');
        Route::post('/comment/{comment}/accept', 'accept')->name('comment.accept');
        Route::post('/comment/{comment}/delete', 'deleteRequest')->name('comment.delete');
    });
});
Route::redirect('/sales', 'sales/dashboard');

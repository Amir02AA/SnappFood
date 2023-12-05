<?php

use App\Http\Controllers\PartyController;
use App\Http\Controllers\salesman\ChartController;
use App\Http\Controllers\salesman\CommentController;
use App\Http\Controllers\salesman\FoodController;
use App\Http\Controllers\salesman\HomeController;
use App\Http\Controllers\salesman\OrderController;
use App\Http\Controllers\salesman\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:sales'])->name('sales.')->prefix('/sales')->group(function () {

    Route::resource('food', FoodController::class);
    Route::controller(HomeController::class)->group(function (){
        Route::get('/profile','profile')->name('profile');
        Route::post('/profile', 'profileStore')->name('profile.store');
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/settings', 'settings')->name('settings');
        Route::post('/settings/{restaurant}','settingsStore')->name('settings.store');
    });

    Route::controller(ScheduleController::class)->name('schedule.')->group(function (){
        Route::get('/schedule', 'schedule')->name('index');
        Route::patch('/schedule', 'setTime')->name('update');
        Route::post('/schedule/close', 'closeDay')->name('close');
    });

    Route::controller(PartyController::class)->name('party.')->group(function (){
        Route::get('food/{food}/party', 'create')->name('create');
        Route::post('food/{food}/party', 'store')->name('store');
        Route::delete('food/{food}/party', 'destroy')->name('destroy');
    });

    Route::controller(OrderController::class)->name('orders.')->group(function (){
        Route::get('orders/{order}/next','nextState')->name('next');
        Route::delete('orders/{order}/cancel','cancel')->name('cancel');
        Route::get('/orders/archive','archive')->name('archive');
        Route::get('/orders/{order}','show')->name('show');
    });
    Route::get('/orders/charts',[ChartController::class,'index'])->name('orders.charts');

    Route::controller(CommentController::class)->name('comment.')->group(function (){
        Route::get('/comment', 'index')->name('index');
        Route::post('/comment/{comment}/reply', 'reply')->name('reply');
        Route::post('/comment/{comment}/accept', 'accept')->name('accept');
        Route::post('/comment/{comment}/delete', 'deleteRequest')->name('delete');
    });
});
Route::redirect('/sales', 'sales/dashboard');

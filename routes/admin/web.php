<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\CommentController;
use App\Http\Controllers\admin\FoodTierController;
use App\Http\Controllers\admin\OffCodeController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\RestaurantTierController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('/admin')->group(function () {
    Route::resources([
        'food' => FoodTierController::class,
        'restaurants' => RestaurantTierController::class
    ]);
    Route::resource('off', OffCodeController::class)->except(['update','edit']);

    Route::resource('banners', BannerController::class)->except(['update','edit','show']);

    Route::get('/panel', [AdminController::class, 'panel'])->name('panel');

    Route::resource('comment', CommentController::class)->only('index','destroy');
    Route::post('comment/{comment}/cancel',[CommentController::class,'cancel'])->name('comment.cancel');
    Route::get('/carts/archive', [OrderController::class, 'archive'])->name('carts.archive');
});
Route::redirect('/admin','/admin/panel');

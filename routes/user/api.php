<?php

use App\Http\Controllers\api\AddressController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CartController;
use App\Http\Controllers\api\CommentController;
use App\Http\Controllers\api\RestaurantController;
use Illuminate\Support\Facades\Route;

Route::get('restaurants/{restaurant}/food',[RestaurantController::class,'food'])->name('restaurants.food');
Route::middleware('auth:sanctum')->name('user.')->group(function () {
    Route::post('carts/{cart}/pay',[CartController::class,'pay'])->name('carts.pay');
    Route::post('/addresses/{address}',[AddressController::class,'setCurrentAddress'])->name('addresses.current');

    Route::apiResource('carts', CartController::class)->except(['destroy']);
    Route::apiResource('addresses', AddressController::class)->only(['index', 'store']);
    Route::apiResource('comments', CommentController::class)->only(['index', 'store']);
    Route::apiResource('restaurants', RestaurantController::class)->only(['index', 'show']);

    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
});

Route::post('/login',[AuthController::class,'login'])->name('login');
Route::post('/register',[AuthController::class,'register'])->name('register');

Route::get('/test',function (){
   return \App\Models\User::find(1)->current;
});

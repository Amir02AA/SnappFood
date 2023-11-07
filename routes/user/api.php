<?php

use App\Http\Controllers\api\AddressController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CartController;
use App\Http\Controllers\api\CommentController;
use App\Http\Controllers\api\RestaurantController;
use Illuminate\Support\Facades\Route;

Route::get('restaurants/{restaurant}/food',[RestaurantController::class,'food'])->name('restaurants.food');
Route::middleware('auth:sanctum')->name('user.')->group(function () {
    Route::post('/carts/{cart}/pay',[CartController::class,'pay']);
    Route::get('/carts',[CartController::class,'index']);
    Route::post('/carts/add',[CartController::class,'store']);
    Route::patch('/carts/add',[CartController::class,'update']);

    Route::get('/comments',[CommentController::class,'index']);
    Route::post('/comments',[CommentController::class,'store']);

    Route::post('/addresses/{address}',[AddressController::class,'setCurrentAddress']);
    Route::apiResource('addresses', AddressController::class)->only(['index', 'store']);
    Route::apiResource('restaurants', RestaurantController::class)->only(['index', 'show']);

    Route::post('/logout',[AuthController::class,'logout']);
});

Route::post('/login',[AuthController::class,'login']);
Route::post('/register',[AuthController::class,'register']);

Route::get('/test',function (\App\Http\Requests\StoreCartRequest $request){
   return $request->validated();
});

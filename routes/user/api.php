<?php

use App\Http\Controllers\api\AddressController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CartController;
use App\Http\Controllers\api\CommentController;
use App\Http\Controllers\api\RestaurantController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum','role:customer'])->prefix('/v1')->group(function () {
    // Carts
    Route::post('/carts/{cart}/pay',[CartController::class,'pay']);
    Route::get('/carts',[CartController::class,'index']);
    Route::get('/carts/{cart}',[CartController::class,'show']);
    Route::post('/carts/add',[CartController::class,'store']);
    Route::patch('/carts/add',[CartController::class,'update']);

    //comment
    Route::get('/comment',[CommentController::class,'index']);
    Route::post('/comment',[CommentController::class,'store']);
    //endcomment

    // Addresses
    Route::post('/addresses/{address}',[AddressController::class,'setCurrentAddress']);
    Route::apiResource('addresses', AddressController::class)->only(['index', 'store']);

    // Restaurants
    Route::apiResource('restaurants', RestaurantController::class)->only(['index', 'show']);
    Route::get('restaurants/{restaurant}/food',[RestaurantController::class,'food']);

    Route::post('/logout',[AuthController::class,'logout']);
});


Route::post('/login',[AuthController::class,'login']);
Route::post('/register',[AuthController::class,'register']);

Route::get('/test',function (\App\Http\Requests\api\StoreCartRequest $request){
   return $request->validated();
});

<?php

use App\Http\Controllers\api\AddressController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CartController;
use App\Http\Controllers\api\CommentController;
use App\Http\Controllers\api\RestaurantController;
use App\Http\Controllers\api\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum','role:customer'])->prefix('/v1')->group(function () {
    // Carts
    Route::controller(CartController::class)->group(function (){
        Route::post('/carts/{cart}/pay','pay');
        Route::get('/carts','index');
        Route::get('/carts/{cart}','show');
        Route::post('/carts/add','store');
        Route::patch('/carts/add','update');
    });

    //comments
    Route::controller(CommentController::class)->group(function (){
        Route::get('/comments','index');
        Route::post('/comments','store');
    });

    // Addresses
    Route::post('/addresses/{address}',[AddressController::class,'setCurrentAddress']);
    Route::apiResource('addresses', AddressController::class)->only(['index', 'store']);

    // Restaurants
    Route::apiResource('restaurants', RestaurantController::class)->only(['index', 'show']);
    Route::get('restaurants/{restaurant}/food',[RestaurantController::class,'food']);

    Route::patch('/user',UserController::class);
});


Route::middleware(['auth:sanctum','role:customer'])->post('/logout',[AuthController::class,'logout']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/register',[AuthController::class,'register']);

Route::get('/test',function (\App\Http\Requests\api\StoreCartRequest $request){
   return $request->validated();
});

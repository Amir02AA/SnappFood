<?php


use Illuminate\Support\Facades\Route;




Route::name('user.')->group(function (){
    Route::get('/addresses')->name('address');
    Route::post('/addresses')->name('address.submit');
    Route::post('/addresses/{address}')->name('address.current');

    Route::get('/restaurants/{restaurant}')->name('restaurants.show');
    Route::get('/restaurants')->name('restaurants');

//    Route::get('/carts')->name('carts.index');
//    Route::get('carts/{cart}')->name('carts.show');
//    Route::post('carts/{cart}/pay')->name('carts.pay');
//    Route::post('/carts/add')->name('carts.store');
//    Route::patch('/carts/add')->name('carts.update');


//    Route::
});

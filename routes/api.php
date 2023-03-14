<?php

use App\Http\Controllers\ItemStatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\BasketItemController;
use App\Http\Controllers\ProductController;

//Products
Route::resource('/product', ProductController::class);

//Basket Items
Route::get('/basket', [BasketItemController::class, 'index']);
Route::post('/basket', [BasketItemController::class, 'store']);
Route::delete('/basket', [BasketItemController::class, 'destroy']);

//Item Statistics
Route::get('/sales/stats', [ItemStatController::class, 'index']);


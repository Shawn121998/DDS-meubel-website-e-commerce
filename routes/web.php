<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;  // <-- HARUS DI ATAS

Route::get('/', function () {
    return view('home');
});

Route::resource('products', ProductController::class);

// ================= CART =================

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::post('/cart/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');

Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
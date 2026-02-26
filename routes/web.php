<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/

// ================= HOME =================
Route::get('/', function () {
    return view('home');
})->name('home');


// ================= PRODUCTS =================
Route::resource('products', ProductController::class);


// ================= CART =================
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');

Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');


// ================= CHECKOUT =================
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');


// ================= LOGIN =================
Route::get('/login', function () {
    return view('auth.login');
})->name('login');


// ================= ADMIN =================
Route::prefix('admin')->group(function () {

    // 1️⃣ Halaman Selamat Datang Admin
    Route::get('/', function () {
        return view('admin.welcome');
    })->name('admin.welcome');

    // 2️⃣ Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    // 3️⃣ Manajemen Produk
    Route::get('/products', function () {
        return view('admin.products');
    })->name('admin.products');

    // 4️⃣ Manajemen Pesanan
    Route::get('/orders', function () {
        return view('admin.orders');
    })->name('admin.orders');

    // 5️⃣ Manajemen Pelanggan
    Route::get('/customers', function () {
        return view('admin.customers');
    })->name('admin.customers');

});
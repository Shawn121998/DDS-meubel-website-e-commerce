<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ReviewController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CustomerController;


/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $products = Product::latest()->get();
    return view('home', compact('products'));
})->name('home');


/*
|--------------------------------------------------------------------------
| PRODUCTS
|--------------------------------------------------------------------------
*/

Route::resource('products', ProductController::class);


/*
|--------------------------------------------------------------------------
| REVIEW
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::post('/review', [ReviewController::class, 'store'])
        ->name('review.store');

});


/*
|--------------------------------------------------------------------------
| CART
|--------------------------------------------------------------------------
*/

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');

Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| CHECKOUT + USER ORDERS
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

    Route::post('/checkout/process', [CheckoutController::class, 'process'])
        ->name('checkout.process');

    Route::get('/my-orders', [CheckoutController::class, 'myOrders'])
        ->name('orders.index');

});


/*
|--------------------------------------------------------------------------
| WISHLIST
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/wishlist', [WishlistController::class, 'index'])
        ->name('wishlist');

    Route::post('/wishlist/add/{id}', [WishlistController::class, 'add'])
        ->name('wishlist.add');

    Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'remove'])
        ->name('wishlist.remove');

});


/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware('auth')->group(function () {

    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    /*
    | DASHBOARD
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');


    /*
    | PRODUK
    */

    Route::get('/products', [AdminProductController::class, 'index'])
        ->name('admin.products');


    /*
    | ORDERS
    */

    Route::get('/orders', [OrderController::class, 'index'])
        ->name('admin.orders');


    /*
    | CUSTOMERS
    */

    Route::get('/customers', [CustomerController::class, 'index'])
        ->name('admin.customers');

});
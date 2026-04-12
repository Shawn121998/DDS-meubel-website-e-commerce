<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CustomOrderController;
use App\Http\Controllers\OrderController; // ✅ TAMBAHAN

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
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

/* ✅ TAMBAHAN ROUTE PRODUK (VERSI INDONESIA) */
Route::resource('produk', ProductController::class);

/*
|--------------------------------------------------------------------------
| AUTH REQUIRED FEATURES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // REVIEW
    Route::post('/review', [ReviewController::class, 'store'])
        ->name('review.store');

    // CUSTOM ORDER
    Route::get('/custom-order', [CustomOrderController::class, 'index'])
        ->name('custom.index');

    Route::post('/custom-order', [CustomOrderController::class, 'store'])
        ->name('custom.store');

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

/* ✅ FIX LOGOUT */
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return view('profile.index');
    })->name('profile');
});

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

    // ✅ TAMBAHAN ORDER
    Route::post('/order', [OrderController::class, 'store'])
        ->name('order.store');

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
Route::prefix('admin')->middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return redirect('/admin/dashboard');
    });

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class,'index'])
        ->name('admin.dashboard');

    // PRODUCTS
    Route::get('/products', [AdminProductController::class, 'index']);
    Route::get('/products/create', [AdminProductController::class, 'create']);

    // ORDERS
    Route::get('/orders', [AdminOrderController::class,'index'])
        ->name('admin.orders');

    // CUSTOMERS
    Route::get('/customers', [CustomerController::class,'index'])
        ->name('admin.customers');

});

Route::get('/admin/dashboard-data', function () {
    return response()->json([
        'produk' => \App\Models\Product::count(),
        'pesanan' => \App\Models\Order::count(),
        'pelanggan' => \App\Models\User::count(),
    ]);
});
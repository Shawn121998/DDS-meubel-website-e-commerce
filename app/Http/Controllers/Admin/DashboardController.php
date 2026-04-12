<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'produk' => Product::count(),
            'pesanan' => Order::count(),
            'pelanggan' => User::count(),
            'orders' => Order::latest()->take(5)->get()
        ]);
    }
}
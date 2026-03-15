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
        // Total Produk
        $totalProducts = Product::count();

        // Total Pesanan
        $totalOrders = Order::count();

        // Total Customer
        $totalCustomers = User::where('role', 'customer')->count();

        // Pesanan terbaru
        $latestOrders = Order::with('user')
                        ->latest()
                        ->take(5)
                        ->get();

        return view('admin.dashboard', [
            'totalProducts' => $totalProducts,
            'totalOrders' => $totalOrders,
            'totalCustomers' => $totalCustomers,
            'latestOrders' => $latestOrders
        ]);
    }
}
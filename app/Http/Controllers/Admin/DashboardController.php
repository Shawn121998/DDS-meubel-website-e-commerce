<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
// nanti kalau sudah ada Order tambahkan juga

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk = Product::count();
        $totalUser = User::count();

        return view('admin.dashboard', compact(
            'totalProduk',
            'totalUser'
        ));
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total produk
        $totalProduk = Product::count();

        // Karena belum ada tabel Order, kita buat 0 dulu
        $totalPesanan = 0;

        // Total pelanggan (User)
        $totalPelanggan = User::count();

        // Pesanan terbaru kosong dulu
        $pesananTerbaru = collect();

        return view('admin.dashboard', compact(
            'totalProduk',
            'totalPesanan',
            'totalPelanggan',
            'pesananTerbaru'
        ));
    }
}
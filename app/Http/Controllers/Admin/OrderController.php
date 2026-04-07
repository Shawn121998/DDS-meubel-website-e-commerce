<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // 🔥 DEBUG: cek apakah data masuk
        if (!$request->has('product_id')) {
            dd('Form tidak mengirim data!');
        }

        // Validasi
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        // Ambil produk
        $product = Product::find($request->product_id);

        if (!$product) {
            return back()->with('error', 'Produk tidak ditemukan');
        }

        try {
            // Simpan ke database
            Order::create([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'user_id' => 1, // sementara
                'total' => $product->price * $request->quantity,
                'status' => 'pending'
            ]);

            return back()->with('success', 'Pesanan berhasil dibuat');

        } catch (\Exception $e) {
            // 🔥 kalau gagal, tampilkan error asli
            dd('ERROR: ' . $e->getMessage());
        }
    }
}
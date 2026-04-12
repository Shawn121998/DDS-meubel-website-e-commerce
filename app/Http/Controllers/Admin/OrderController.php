<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();
        return view('admin.orders', compact('orders')); // ✅ FIX
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = Product::find($request->product_id);

        if (!$product) {
            return back()->with('error', 'Produk tidak ditemukan.');
        }

        try {
            Order::create([
                'product_id' => $request->product_id,
                'quantity'   => $request->quantity,
                'user_id'    => 1,
                'total'      => $product->price * $request->quantity,
                'status'     => 'pending',
            ]);

            return back()->with('success', 'Pesanan berhasil dibuat.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menyimpan pesanan.');
        }
    }
}
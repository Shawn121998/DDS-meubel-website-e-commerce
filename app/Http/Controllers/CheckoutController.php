<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang belanja kosong.');
        }

        $subtotal = 0;

        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        return view('checkout.index', compact('cart', 'subtotal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang belanja kosong.');
        }

        $firstKey = array_key_first($cart);
        $firstItem = $cart[$firstKey];

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // ✅ SIMPAN ORDER
        $order = Order::create([
            'user_id' => Auth::id(),
            'product_id' => $firstKey,
            'quantity' => $firstItem['quantity'],
            'total' => $total,
            'status' => 'menunggu pembayaran',
            'customer_name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'payment_method' => $request->payment_method ?? 'Transfer Bank',
            'order_number' => '#' . time() . rand(1000, 9999),
            'type' => 'reguler',
        ]);

        // ✅ HAPUS CART
        session()->forget('cart');

        // ✅ REDIRECT KE HALAMAN KONFIRMASI
        return redirect()->route('checkout.success', $order->id);
    }

    public function process(Request $request)
    {
        return $this->store($request);
    }

    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())
            ->latest()
            ->get();

        $customOrders = \App\Models\CustomOrder::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders', 'customOrders'));
    }

    // ✅ TAMBAHAN HALAMAN SUCCESS
    public function success($id)
    {
        $order = Order::with('product')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('checkout.success', compact('order'));
    }
}
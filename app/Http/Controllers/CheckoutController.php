<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout.index');
    }

    public function process(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'payment' => 'required',
        ]);

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index');
        }

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $order = [
            'order_id' => '#' . time(),
            'date' => now()->format('d/m/Y'),
            'items' => $cart,
            'total' => $total,
            'address' => $request->address . ', ' . $request->city . ', ' . $request->postal_code,
            'payment' => $request->payment == 'transfer' ? 'Transfer Bank' : 'Cash',
            'status' => 'Menunggu Pembayaran'
        ];

        session()->put('last_order', $order);

        // kosongkan cart
        session()->forget('cart');

        return redirect()->route('orders.index');
    }

    public function myOrders()
    {
        $order = session('last_order');

        return view('orders.index', compact('order'));
    }
}
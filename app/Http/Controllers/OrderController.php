<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\CustomOrder;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        $customOrders = CustomOrder::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders', 'customOrders'));
    }

    public function show($id)
    {
        $order = Order::with('product')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('orders.show', compact('order'));
    }

    // ✅ TAMBAHAN UNTUK REALTIME STATUS CUSTOMER
    public function myOrderStatusData()
    {
        $orders = Order::where('user_id', Auth::id())
            ->select('id', 'status')
            ->get()
            ->map(function ($order) {
                return [
                    'id' => $order->id,
                    'status' => $order->status,
                    'status_label' => ucfirst($order->status),
                    'badge_class' => match ($order->status) {
                        'menunggu pembayaran' => 'bg-yellow-100 text-yellow-700',
                        'diproses' => 'bg-blue-100 text-blue-700',
                        'dikirim' => 'bg-indigo-100 text-indigo-700',
                        'selesai' => 'bg-green-100 text-green-700',
                        default => 'bg-gray-100 text-gray-700',
                    },
                ];
            });

        return response()->json($orders);
    }
}
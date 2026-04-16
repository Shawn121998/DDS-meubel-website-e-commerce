<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['product', 'user'])
            ->latest()
            ->get();

        return view('admin.orders', compact('orders'));
    }

    public function updateStatus(Request $request, $id, $status = null)
    {
        $allowedStatus = ['menunggu pembayaran', 'diproses', 'dikirim', 'selesai'];

        // Ambil dari AJAX atau URL lama
        $newStatus = $request->input('status', $status);

        if (!in_array($newStatus, $allowedStatus)) {
            // kalau request dari AJAX
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Status tidak valid'
                ], 400);
            }

            return redirect()->back()->with('error', 'Status tidak valid');
        }

        $order = Order::findOrFail($id);
        $order->status = $newStatus;
        $order->save();

        // kalau request dari AJAX (realtime)
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'order_id' => $order->id,
                'status' => $order->status,
                'status_label' => ucfirst($order->status),
                'badge_class' => $this->getBadgeClass($order->status),
            ]);
        }

        // fallback lama (biar tidak rusak sistem lama)
        return redirect()->back()->with('success', 'Status pesanan berhasil diupdate');
    }

    public function statusData()
    {
        $orders = Order::select('id', 'status')->get()->map(function ($order) {
            return [
                'id' => $order->id,
                'status' => $order->status,
                'status_label' => ucfirst($order->status),
                'badge_class' => $this->getBadgeClass($order->status),
            ];
        });

        return response()->json($orders);
    }

    private function getBadgeClass($status)
    {
        return match ($status) {
            'menunggu pembayaran' => 'bg-yellow-100 text-yellow-700',
            'diproses' => 'bg-blue-100 text-blue-700',
            'dikirim' => 'bg-indigo-100 text-indigo-700',
            'selesai' => 'bg-green-100 text-green-700',
            default => 'bg-gray-100 text-gray-700',
        };
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'product'])->latest();

        // Filter tanggal mulai
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        // Filter tanggal akhir
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(10)->withQueryString();

        // Query untuk ringkasan laporan
        $summaryQuery = Order::query();

        if ($request->filled('start_date')) {
            $summaryQuery->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $summaryQuery->whereDate('created_at', '<=', $request->end_date);
        }

        if ($request->filled('status')) {
            $summaryQuery->where('status', $request->status);
        }

        $totalTransactions = (clone $summaryQuery)->count();
        $totalSales = (clone $summaryQuery)->sum('total');
        $completedOrders = (clone $summaryQuery)->where('status', 'selesai')->count();
        $averageTransaction = $totalTransactions > 0 ? $totalSales / $totalTransactions : 0;

        return view('admin.reports.index', compact(
            'orders',
            'totalTransactions',
            'totalSales',
            'completedOrders',
            'averageTransaction'
        ));
    }
}
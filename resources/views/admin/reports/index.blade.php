@extends('layouts.admin')

@section('content')
<style>
    .report-page {
        width: 100%;
    }

    .report-header {
        margin-bottom: 28px;
    }

    .report-title {
        font-size: 36px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 8px;
    }

    .report-subtitle {
        font-size: 15px;
        color: #64748b;
    }

    .report-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);
    }

    .filter-card {
        padding: 24px;
        margin-bottom: 26px;
    }

    .filter-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        align-items: end;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 10px;
    }

    .form-control-custom,
    .form-select-custom {
        width: 100%;
        height: 48px;
        border: 1px solid #dbe2ea;
        border-radius: 14px;
        padding: 0 14px;
        font-size: 15px;
        color: #0f172a;
        background: #fff;
        outline: none;
        transition: 0.2s ease;
    }

    .form-control-custom:focus,
    .form-select-custom:focus {
        border-color: #0f172a;
        box-shadow: 0 0 0 3px rgba(15, 23, 42, 0.08);
    }

    .filter-actions {
        display: flex;
        gap: 12px;
    }

    .btn-filter,
    .btn-reset {
        height: 48px;
        border-radius: 14px;
        font-size: 15px;
        font-weight: 600;
        padding: 0 20px;
        border: none;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: 0.2s ease;
    }

    .btn-filter {
        background: #07152b;
        color: #ffffff;
        min-width: 120px;
    }

    .btn-filter:hover {
        background: #0f223f;
        color: #ffffff;
    }

    .btn-reset {
        background: #f8fafc;
        color: #334155;
        border: 1px solid #dbe2ea;
        min-width: 110px;
    }

    .btn-reset:hover {
        background: #eef2f7;
        color: #0f172a;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 26px;
    }

    .stat-card {
        padding: 24px;
        min-height: 150px;
        position: relative;
        overflow: hidden;
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 18px;
    }

    .icon-sales {
        background: #dbeafe;
        color: #2563eb;
    }

    .icon-transaction {
        background: #dcfce7;
        color: #16a34a;
    }

    .icon-success {
        background: #fef3c7;
        color: #d97706;
    }

    .icon-average {
        background: #f3e8ff;
        color: #9333ea;
    }

    .stat-label {
        font-size: 15px;
        color: #64748b;
        margin-bottom: 8px;
    }

    .stat-value {
        font-size: 30px;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.2;
    }

    .table-card {
        overflow: hidden;
    }

    .table-card-header {
        padding: 24px 28px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
    }

    .table-title {
        font-size: 24px;
        font-weight: 700;
        color: #0f172a;
    }

    .table-subtitle {
        font-size: 14px;
        color: #64748b;
        margin-top: 4px;
    }

    .table-responsive-custom {
        overflow-x: auto;
    }

    .sales-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 900px;
    }

    .sales-table thead th {
        text-align: left;
        padding: 18px 28px;
        font-size: 13px;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background: #f8fafc;
    }

    .sales-table tbody td {
        padding: 20px 28px;
        font-size: 15px;
        color: #334155;
        border-top: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .sales-table tbody tr:hover {
        background: #f8fafc;
    }

    .order-id {
        font-weight: 700;
        color: #0f172a;
    }

    .product-name {
        font-weight: 600;
        color: #0f172a;
    }

    .total-price {
        font-weight: 700;
        color: #0f172a;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-pending {
        background: #fef3c7;
        color: #b45309;
    }

    .status-process {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .status-shipping {
        background: #ede9fe;
        color: #7c3aed;
    }

    .status-done {
        background: #dcfce7;
        color: #15803d;
    }

    .status-default {
        background: #f1f5f9;
        color: #475569;
    }

    .empty-data {
        text-align: center;
        padding: 36px 20px;
        color: #64748b;
        font-size: 15px;
    }

    .pagination-wrapper {
        padding: 18px 28px;
        border-top: 1px solid #e5e7eb;
        background: #ffffff;
    }

    @media (max-width: 1200px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .filter-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .report-title {
            font-size: 28px;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .filter-grid {
            grid-template-columns: 1fr;
        }

        .filter-actions {
            flex-direction: column;
        }

        .btn-filter,
        .btn-reset {
            width: 100%;
        }

        .table-card-header {
            padding: 20px;
        }

        .sales-table thead th,
        .sales-table tbody td {
            padding: 16px 18px;
        }

        .pagination-wrapper {
            padding: 16px 20px;
        }
    }
</style>

<div class="report-page">
    <div class="report-header">
        <div class="report-title">Laporan Penjualan</div>
        <div class="report-subtitle">Menampilkan data hasil penjualan pada sistem DDS Meubel.</div>
    </div>

    <div class="report-card filter-card">
        <form action="{{ route('admin.reports.index') }}" method="GET">
            <div class="filter-grid">
                <div class="form-group">
                    <label for="start_date">Tanggal Mulai</label>
                    <input
                        type="date"
                        id="start_date"
                        name="start_date"
                        value="{{ request('start_date') }}"
                        class="form-control-custom"
                    >
                </div>

                <div class="form-group">
                    <label for="end_date">Tanggal Akhir</label>
                    <input
                        type="date"
                        id="end_date"
                        name="end_date"
                        value="{{ request('end_date') }}"
                        class="form-control-custom"
                    >
                </div>

                <div class="form-group">
                    <label for="status">Status Pesanan</label>
                    <select id="status" name="status" class="form-select-custom">
                        <option value="">Semua Status</option>
                        <option value="menunggu pembayaran" {{ request('status') == 'menunggu pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                        <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="dikirim" {{ request('status') == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <div class="filter-actions">
                    <button type="submit" class="btn-filter">Filter</button>
                    <a href="{{ route('admin.reports.index') }}" class="btn-reset">Reset</a>
                </div>
            </div>
        </form>
    </div>

    <div class="stats-grid">
        <div class="report-card stat-card">
            <div class="stat-icon icon-sales">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M3 3v18h18"></path>
                    <path d="M7 14l3-3 3 2 4-5"></path>
                </svg>
            </div>
            <div class="stat-label">Total Penjualan</div>
            <div class="stat-value">Rp {{ number_format($totalSales, 0, ',', '.') }}</div>
        </div>

        <div class="report-card stat-card">
            <div class="stat-icon icon-transaction">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <circle cx="9" cy="19" r="1"></circle>
                    <circle cx="17" cy="19" r="1"></circle>
                    <path d="M3 4h2l2.5 10h10.5l2-7H6"></path>
                </svg>
            </div>
            <div class="stat-label">Total Transaksi</div>
            <div class="stat-value">{{ $totalTransactions }}</div>
        </div>

        <div class="report-card stat-card">
            <div class="stat-icon icon-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M20 6 9 17l-5-5"></path>
                </svg>
            </div>
            <div class="stat-label">Pesanan Selesai</div>
            <div class="stat-value">{{ $completedOrders }}</div>
        </div>

        <div class="report-card stat-card">
            <div class="stat-icon icon-average">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M12 3v18"></path>
                    <path d="M17 8l-5-5-5 5"></path>
                </svg>
            </div>
            <div class="stat-label">Rata-rata Transaksi</div>
            <div class="stat-value">Rp {{ number_format($averageTransaction, 0, ',', '.') }}</div>
        </div>
    </div>

    <div class="report-card table-card">
        <div class="table-card-header">
            <div>
                <div class="table-title">Data Penjualan</div>
                <div class="table-subtitle">Daftar transaksi penjualan DDS Meubel</div>
            </div>
        </div>

        <div class="table-responsive-custom">
            <table class="sales-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Pelanggan</th>
                        <th>Produk</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        @php
                            $status = strtolower($order->status ?? '');

                            if ($status == 'menunggu pembayaran') {
                                $statusClass = 'status-pending';
                            } elseif ($status == 'diproses') {
                                $statusClass = 'status-process';
                            } elseif ($status == 'dikirim') {
                                $statusClass = 'status-shipping';
                            } elseif ($status == 'selesai') {
                                $statusClass = 'status-done';
                            } else {
                                $statusClass = 'status-default';
                            }
                        @endphp
                        <tr>
                            <td class="order-id">#{{ $order->id }}</td>
                            <td>{{ $order->user->name ?? 'User tidak ditemukan' }}</td>
                            <td class="product-name">{{ $order->product->name ?? 'Produk tidak ditemukan' }}</td>
                            <td>{{ $order->created_at ? $order->created_at->format('d M Y') : '-' }}</td>
                            <td>
                                <span class="status-badge {{ $statusClass }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="total-price">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-data">Data penjualan belum tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
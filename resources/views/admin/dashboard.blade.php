<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - DDS Meubel</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f3f4f6;
            color: #0f172a;
        }

        .dashboard-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 275px;
            background: #ffffff;
            border-right: 1px solid #e5e7eb;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar-top {
            padding: 28px 18px 20px;
        }

        .brand-title {
            font-size: 28px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .brand-subtitle {
            font-size: 15px;
            color: #64748b;
        }

        .menu {
            padding: 0 12px;
        }

        .menu a,
        .menu button {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
            color: #334155;
            padding: 16px 18px;
            border-radius: 16px;
            font-size: 17px;
            border: none;
            background: transparent;
            cursor: pointer;
            margin-bottom: 10px;
            text-align: left;
        }

        .menu a:hover,
        .menu button:hover {
            background: #f1f5f9;
        }

        .menu .active {
            background: #07152b;
            color: #ffffff;
        }

        .menu .logout {
            color: #ef4444;
            font-weight: 600;
        }

        .menu-divider {
            border-top: 1px solid #e5e7eb;
            margin: 14px 12px;
        }

        .sidebar-icon {
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .main-content {
            flex: 1;
            padding: 34px 36px;
        }

        .page-title {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 28px;
            color: #0f172a;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 26px;
            margin-bottom: 34px;
        }

        .stat-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            padding: 28px;
            min-height: 190px;
        }

        .stat-icon-box {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 22px;
        }

        .icon-blue {
            background: #dbeafe;
            color: #2563eb;
        }

        .icon-green {
            background: #dcfce7;
            color: #16a34a;
        }

        .icon-purple {
            background: #f3e8ff;
            color: #9333ea;
        }

        .stat-number {
            font-size: 30px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .stat-label {
            font-size: 16px;
            color: #475569;
        }

        .table-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            overflow: hidden;
        }

        .table-header {
            padding: 28px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 24px;
            font-weight: 700;
            color: #0f172a;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            text-align: left;
            padding: 18px 28px;
            font-size: 14px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tbody td {
            padding: 20px 28px;
            font-size: 16px;
            color: #334155;
            border-top: 1px solid #f1f5f9;
        }

        .empty-row td {
            text-align: center;
            color: #64748b;
            padding: 26px 28px;
        }

        .badge {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
        }

        .badge-pending {
            background: #fef3c7;
            color: #b45309;
        }

        .badge-success {
            background: #dcfce7;
            color: #15803d;
        }

        .badge-process {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .badge-default {
            background: #f1f5f9;
            color: #475569;
        }

        form {
            margin: 0;
        }

        @media (max-width: 1100px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 900px) {
            .dashboard-wrapper {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                min-height: auto;
            }

            .main-content {
                padding: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-wrapper">
        <aside class="sidebar">
            <div>
                <div class="sidebar-top">
                    <div class="brand-title">DDS Meubel</div>
                    <div class="brand-subtitle">Admin Panel</div>
                </div>

                <div class="menu">
                    <a href="{{ route('admin.dashboard') }}" class="active">
                        <span class="sidebar-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="7" height="7" rx="1"></rect>
                                <rect x="14" y="3" width="7" height="7" rx="1"></rect>
                                <rect x="3" y="14" width="7" height="7" rx="1"></rect>
                                <rect x="14" y="14" width="7" height="7" rx="1"></rect>
                            </svg>
                        </span>
                        Dashboard
                    </a>

                    <a href="{{ route('produk.index') }}">
                        <span class="sidebar-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <circle cx="9" cy="19" r="1"></circle>
                                <circle cx="17" cy="19" r="1"></circle>
                                <path d="M3 4h2l2.5 10h10.5l2-7H6"></path>
                            </svg>
                        </span>
                        Manajemen Produk
                    </a>

                    <a href="{{ url('/admin/orders') }}">
                        <span class="sidebar-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <circle cx="9" cy="19" r="1"></circle>
                                <circle cx="17" cy="19" r="1"></circle>
                                <path d="M3 4h2l2.5 10h10.5l2-7H6"></path>
                            </svg>
                        </span>
                        Manajemen Pesanan
                    </a>
                    <a href="{{ route('admin.reports.index') }}">
    <span class="sidebar-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path d="M4 19h16"></path>
            <path d="M7 16V10"></path>
            <path d="M12 16V5"></path>
            <path d="M17 16v-8"></path>
        </svg>
    </span>
    Laporan Penjualan
</a>

                    <a href="#">
                        <span class="sidebar-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M12 20h9"></path>
                                <path d="M16.5 3.5a2.1 2.1 0 1 1 3 3L7 19l-4 1 1-4Z"></path>
                            </svg>
                        </span>
                        Pesanan Custom
                    </a>

                    <a href="{{ route('admin.customers') }}">
                        <span class="sidebar-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="10" cy="7" r="4"></circle>
                                <path d="M20 8v6"></path>
                                <path d="M23 11h-6"></path>
                            </svg>
                        </span>
                        Manajemen Pelanggan
                    </a>
                </div>

                <div class="menu-divider"></div>

                <div class="menu">
                    <a href="{{ route('home') }}">
                        <span class="sidebar-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M3 10.5 12 3l9 7.5"></path>
                                <path d="M5 9.5V21h14V9.5"></path>
                            </svg>
                        </span>
                        Kembali ke Toko
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout">
                            <span class="sidebar-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <path d="M16 17l5-5-5-5"></path>
                                    <path d="M21 12H9"></path>
                                </svg>
                            </span>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <main class="main-content">
            <div class="page-title">Dashboard Admin</div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon-box icon-blue">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                            <path d="M3.3 7l8.7 5 8.7-5"/>
                            <path d="M12 22V12"/>
                        </svg>
                    </div>
                    <div class="stat-number">{{ $produk }}</div>
                    <div class="stat-label">Total Produk</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon-box icon-green">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <circle cx="9" cy="19" r="1"></circle>
                            <circle cx="17" cy="19" r="1"></circle>
                            <path d="M3 4h2l2.5 10h10.5l2-7H6"></path>
                        </svg>
                    </div>
                    <div class="stat-number">{{ $pesanan }}</div>
                    <div class="stat-label">Total Pesanan</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon-box icon-purple">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="10" cy="7" r="4"></circle>
                            <path d="M20 8v6"></path>
                            <path d="M23 11h-6"></path>
                        </svg>
                    </div>
                    <div class="stat-number">{{ $pelanggan }}</div>
                    <div class="stat-label">Total Pelanggan</div>
                </div>
            </div>

            <div class="table-card">
                <div class="table-header">Pesanan Terbaru</div>

                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Pelanggan</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->name ?? ($order->user->name ?? '-') }}</td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                <td>
                                    @php
                                        $status = strtolower($order->status ?? 'pending');
                                    @endphp

                                    @if($status == 'pending')
                                        <span class="badge badge-pending">Pending</span>
                                    @elseif($status == 'selesai')
                                        <span class="badge badge-success">Selesai</span>
                                    @elseif($status == 'diproses')
                                        <span class="badge badge-process">Diproses</span>
                                    @else
                                        <span class="badge badge-default">{{ ucfirst($order->status ?? 'Pending') }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr class="empty-row">
                                <td colspan="5">Belum ada pesanan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
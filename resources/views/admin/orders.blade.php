<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pesanan - DDS Meubel</title>
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

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 275px;
            background: #ffffff;
            border-right: 1px solid #e5e7eb;
            padding: 28px 16px;
        }

        .brand-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .brand-subtitle {
            font-size: 15px;
            color: #64748b;
            margin-bottom: 28px;
        }

        .menu a,
        .menu button {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #334155;
            padding: 14px 16px;
            border-radius: 14px;
            font-size: 16px;
            margin-bottom: 10px;
            border: none;
            background: transparent;
            cursor: pointer;
        }

        .menu a:hover,
        .menu button:hover {
            background: #f1f5f9;
        }

        .menu .active {
            background: #07152b;
            color: white;
        }

        .divider {
            border-top: 1px solid #e5e7eb;
            margin: 20px 0;
        }

        .logout {
            color: #ef4444 !important;
            font-weight: 600;
        }

        .content {
            flex: 1;
            padding: 32px 36px;
        }

        .title {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 24px;
        }

        .card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            overflow: hidden;
        }

        .card-header {
            padding: 24px 28px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 24px;
            font-weight: 700;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            text-align: left;
            padding: 18px 24px;
            font-size: 14px;
            text-transform: uppercase;
            color: #64748b;
            border-bottom: 1px solid #e5e7eb;
        }

        tbody td {
            padding: 18px 24px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 15px;
            color: #334155;
            vertical-align: top;
        }

        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
        }

        .pending {
            background: #fef3c7;
            color: #b45309;
        }

        .diproses {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .selesai {
            background: #dcfce7;
            color: #15803d;
        }

        .default {
            background: #f1f5f9;
            color: #475569;
        }

        .empty {
            text-align: center;
            color: #64748b;
            padding: 28px;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <aside class="sidebar">
        <div class="brand-title">DDS Meubel</div>
        <div class="brand-subtitle">Admin Panel</div>

        <div class="menu">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('produk.index') }}">Manajemen Produk</a>
            <a href="{{ route('admin.orders.index') }}" class="active">Manajemen Pesanan</a>
            <a href="{{ route('admin.customers') }}">Manajemen Pelanggan</a>

            <div class="divider"></div>

            <a href="{{ route('home') }}">Kembali ke Toko</a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout">Logout</button>
            </form>
        </div>
    </aside>

    <main class="content">
        <div class="title">Manajemen Pesanan</div>

        <div class="card">
            <div class="card-header">Daftar Pesanan</div>

            <!-- TAMBAHAN RESPONSIVE -->
            <div style="overflow-x:auto;">
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Pelanggan</th>
                        <th>Produk</th> <!-- TAMBAHAN -->
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th> <!-- TAMBAHAN -->
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->user->name ?? $order->name ?? '-' }}</td>

                            <!-- TAMBAHAN PRODUK -->
                            <td>{{ $order->product->name ?? '-' }}</td>

                            <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
<td>
    <span id="status-{{ $order->id }}" class="badge
        @if($order->status == 'menunggu pembayaran') pending
        @elseif($order->status == 'diproses') diproses
        @elseif($order->status == 'dikirim') default
        @elseif($order->status == 'selesai') selesai
        @else default
        @endif
    ">
        {{ ucfirst($order->status) }}
    </span>
</td>

                            <!-- TAMBAHAN AKSI -->
                            <td>
    <div style="display:flex; gap:8px; flex-wrap:wrap;">

        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" style="display:inline;">
            @csrf
            <input type="hidden" name="status" value="diproses">
            <button type="submit" class="badge diproses" style="border:none; cursor:pointer;">
                Diproses
            </button>
        </form>

        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" style="display:inline;">
            @csrf
            <input type="hidden" name="status" value="dikirim">
            <button type="submit" class="badge default" style="border:none; cursor:pointer;">
                Dikirim
            </button>
        </form>

        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" style="display:inline;">
            @csrf
            <input type="hidden" name="status" value="selesai">
            <button type="submit" class="badge selesai" style="border:none; cursor:pointer;">
                Selesai
            </button>
        </form>

    </div>
</td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty">Belum ada pesanan</td> <!-- TAMBAHAN -->
                        </tr>
                    @endforelse
                </tbody>
            </table>
            </div> <!-- PENUTUP RESPONSIVE -->
        </div>
    </main>
</div>
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
document.addEventListener('DOMContentLoaded', function () {

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.querySelectorAll('a[href*="/admin/orders/"]').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();

            const url = this.getAttribute('href');
            const parts = url.split('/');

            const orderId = parts[3];
            const status = parts[4];

            fetch(`/admin/orders/${orderId}/status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ status: status })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        });
    });

});
</script>
</body>
</html>
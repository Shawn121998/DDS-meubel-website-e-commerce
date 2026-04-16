<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>DDS Meubel Admin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>

body {
    background: #f4f6f9;
    font-family: 'Segoe UI', sans-serif;
}

/* SIDEBAR */
.sidebar {
    width: 250px;
    height: 100vh;
    position: fixed;
    background: #fff;
    border-right: 1px solid #eee;
    padding: 20px;
}

.sidebar h5 {
    font-weight: bold;
}

.sidebar p {
    font-size: 13px;
    color: gray;
}

.sidebar a {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px;
    color: #333;
    text-decoration: none;
    border-radius: 10px;
    margin-bottom: 8px;
}

/* ACTIVE MENU */
.sidebar a.active {
    background: #0d1b2a;
    color: #fff;
}

.sidebar a:hover {
    background: #0d1b2a;
    color: #fff;
}

/* CONTENT */
.content {
    margin-left: 260px;
    padding: 30px;
}

/* CARD */
.card-stat {
    border: none;
    border-radius: 15px;
    padding: 20px;
    background: #fff;
}

.icon-box {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.icon-blue { background: #e0ecff; color: #3b82f6; }
.icon-green { background: #dcfce7; color: #22c55e; }
.icon-purple { background: #f3e8ff; color: #a855f7; }

/* TABLE */
.table {
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
}

</style>

</head>

<body>

<div class="sidebar">

<h5>DDS Meubel</h5>
<p>Admin Panel</p>

<a href="{{ url('/admin/dashboard') }}" class="active">
<i class="fa fa-home"></i> Dashboard
</a>

<a href="{{ url('/admin/products') }}">
<i class="fa fa-box"></i> Manajemen Produk
</a>

<a href="{{ url('/admin/orders') }}">
<i class="fa fa-shopping-cart"></i> Manajemen Pesanan
</a>

<a href="{{ route('admin.reports.index') }}">
<i class="fa fa-chart-bar"></i> Laporan Penjualan
</a>

<a href="{{ url('/admin/customers') }}">
<i class="fa fa-users"></i> Manajemen Pelanggan
</a>

<a href="{{ url('/') }}">
<i class="fa fa-arrow-left"></i> Kembali ke Toko
</a>

</div>

<div class="content">
    @yield('content')
</div>

</body>
</html>
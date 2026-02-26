<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - DDS Meubel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: #ffffff;
            border-right: 1px solid #eee;
        }

        .sidebar h4 {
            font-weight: bold;
        }

        .sidebar .nav-link {
            color: #555;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 8px;
        }

        .sidebar .nav-link.active {
            background: #0d1b2a;
            color: #fff;
        }

        .sidebar .nav-link:hover {
            background: #0d1b2a;
            color: #fff;
        }

        .content-area {
            flex: 1;
            padding: 30px;
        }

        .card-stat {
            border-radius: 15px;
            padding: 25px;
            border: none;
            background: #ffffff;
        }

        @media (max-width: 992px) {
            .sidebar {
                position: fixed;
                z-index: 1000;
                left: -260px;
                transition: 0.3s;
            }

            .sidebar.show {
                left: 0;
            }
        }
    </style>
</head>
<body>

<div class="d-flex">

    {{-- SIDEBAR --}}
    <div class="sidebar p-4" id="sidebar">
        <h4>DDS Meubel</h4>
        <small class="text-muted">Admin Panel</small>

        <hr>

        <ul class="nav flex-column">

            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}"
                   class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a href="#"
                   class="nav-link">
                    Manajemen Produk
                </a>
            </li>

            <li class="nav-item">
                <a href="#"
                   class="nav-link">
                    Manajemen Pesanan
                </a>
            </li>

            <li class="nav-item">
                <a href="#"
                   class="nav-link">
                    Manajemen Pelanggan
                </a>
            </li>

            <li class="nav-item mt-3">
                <a href="{{ route('home') }}" class="nav-link">
                    Kembali ke Toko
                </a>
            </li>

        </ul>
    </div>

    {{-- CONTENT --}}
    <div class="content-area w-100">
        @yield('content')
    </div>

</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('show');
    }
</script>

</body>
</html>
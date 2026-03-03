<!DOCTYPE html>
<html>
<head>
    <title>DDS Meubel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #F5EFE6;
            font-family: 'Poppins', sans-serif;
        }

        /* NAVBAR EARTH TONE */
        .earth-navbar {
            background-color: #F5EFE6;
            padding: 18px 0;
            border-bottom: 1px solid #E8DFD0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 22px;
            color: #2F2A25 !important;
        }

        .nav-link {
            color: #5C5248 !important;
            font-weight: 500;
            margin: 0 15px;
            position: relative;
        }

        .nav-link.active {
            color: #7A5C3E !important;
        }

        .nav-link.active::after {
            content: "";
            position: absolute;
            bottom: -6px;
            left: 0;
            width: 100%;
            height: 2px;
            background: #7A5C3E;
        }

        .nav-icon {
            color: #5C5248;
            font-size: 20px;
            position: relative;
            transition: 0.3s;
        }

        .nav-icon:hover {
            color: #7A5C3E;
        }

        .cart-badge {
            position: absolute;
            top: -6px;
            right: -10px;
            background: #7A5C3E;
            color: white;
            font-size: 10px;
            padding: 3px 6px;
            border-radius: 50px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg earth-navbar">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('home') }}">
            DDS Meubel
        </a>

        <!-- Toggle for mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Center Menu -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                       href="{{ route('home') }}">
                        Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}"
                       href="{{ route('products.index') }}">
                        Produk
                    </a>
                </li>
            </ul>
        </div>

        <!-- Right Icons -->
        <div class="d-flex align-items-center gap-3">

            <!-- Wishlist -->
            <a href="#" class="nav-icon">
                <i class="bi bi-heart"></i>
            </a>

            <!-- Cart -->
            <a href="{{ route('cart.index') }}" class="nav-icon">
                <i class="bi bi-cart"></i>

                @if(session('cart'))
                    <span class="cart-badge">
                        {{ count(session('cart')) }}
                    </span>
                @endif
            </a>

            <!-- User -->
            <a href="{{ route('login') }}" class="nav-icon">
                <i class="bi bi-person"></i>
            </a>

        </div>

    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
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

        <!-- Toggle mobile -->
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

            <!-- Wishlist FIX -->
            <a href="{{ route('wishlist') }}" class="nav-icon">
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


<footer style="background:#0f1f3a; color:white; margin-top:60px;">
<div class="container py-5">

<div class="row g-4">

<!-- DDS MEUBEL -->
<div class="col-md-3">
<h5 class="fw-bold">DDS Meubel</h5>

<p style="color:#cbd5e1;">
Menyediakan furniture kayu berkualitas tinggi seperti
lemari dan meja dari kayu jati dan mahoni untuk rumah Anda.
</p>
</div>


<!-- NAVIGASI -->
<div class="col-md-3">
<h5 class="fw-bold">Navigasi</h5>

<ul class="list-unstyled">

<li>
<a href="{{ url('/') }}" style="color:#cbd5e1; text-decoration:none;">
Beranda
</a>
</li>

<li>
<a href="{{ route('products.index') }}" style="color:#cbd5e1; text-decoration:none;">
Produk
</a>
</li>

<li>
<a href="{{ route('cart.index') }}" style="color:#cbd5e1; text-decoration:none;">
Keranjang
</a>
</li>

<li>
<a href="{{ route('wishlist') }}" style="color:#cbd5e1; text-decoration:none;">
Wishlist
</a>
</li>

</ul>
</div>


<!-- AKUN -->
<div class="col-md-3">
<h5 class="fw-bold">Akun</h5>

<ul class="list-unstyled">

<li>
<a href="{{ route('login') }}" style="color:#cbd5e1; text-decoration:none;">
Login
</a>
</li>

<li>
<a href="{{ route('register') }}" style="color:#cbd5e1; text-decoration:none;">
Registrasi
</a>
</li>

<li>
<a href="#" style="color:#cbd5e1; text-decoration:none;">
Pesanan Saya
</a>
</li>

</ul>
</div>


<!-- KONTAK -->
<div class="col-md-3">
<h5 class="fw-bold">Kontak</h5>

<p style="color:#cbd5e1;">Email: info@ddsmeubel.com</p>
<p style="color:#cbd5e1;">Email: shawnsumual@gmail.com</p>
<p style="color:#cbd5e1;">Telepon: (62) 89698118036 </p>
<p style="color:#cbd5e1;">WhatsApp: 082190104062</p>

</div>

</div>

<hr style="border-color:#334155; margin-top:30px;">

<div class="text-center" style="color:#cbd5e1;">
© 2026 DDS Meubel. All rights reserved.
</div>

</div>
</footer>

</body>
</html>
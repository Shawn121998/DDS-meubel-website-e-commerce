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
        }

        .nav-icon {
            color: #5C5248;
            font-size: 20px;
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

        /* USER */
        .user-box{
            display:flex;
            align-items:center;
            gap:10px;
            background:#ffffff;
            padding:6px 14px;
            border-radius:20px;
            border:1px solid #E8DFD0;
        }

        .user-icon{
            width:32px;
            height:32px;
            background:#ff7a00;
            color:white;
            display:flex;
            align-items:center;
            justify-content:center;
            border-radius:50%;
            font-size:13px;
            font-weight:bold;
        }

        .user-info small{
            font-size:11px;
            color:#777;
        }

        .user-info strong{
            font-size:13px;
        }

        /* DROPDOWN */
        .profile-wrapper{
            position:relative;
        }

        .profile-dropdown{
            position:absolute;
            top:55px;
            right:0;
            width:260px;
            background:white;
            border-radius:15px;
            box-shadow:0 5px 20px rgba(0,0,0,0.1);
            display:none;
            z-index:999;
        }

        .profile-wrapper:hover .profile-dropdown{
            display:block;
        }

        .profile-header{
            background:#fff3e6;
            padding:15px;
            display:flex;
            gap:10px;
            align-items:center;
        }

        .profile-avatar{
            width:45px;
            height:45px;
            background:#ff7a00;
            color:white;
            display:flex;
            align-items:center;
            justify-content:center;
            border-radius:50%;
            font-weight:bold;
        }

        .dropdown-item{
            padding:12px 16px;
            display:block;
            text-decoration:none;
            color:#333;
        }

        .dropdown-item:hover{
            background:#f5f5f5;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light earth-navbar">
    <div class="container">

        <a class="navbar-brand" href="{{ route('home') }}">DDS Meubel</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="navbarContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.index') }}">Produk</a>
                </li>
            </ul>
        </div>

        <div class="d-flex align-items-center gap-3">

            <a href="{{ route('wishlist') }}" class="nav-icon">
                <i class="bi bi-heart"></i>
            </a>

            <a href="{{ route('cart.index') }}" class="nav-icon position-relative">
                <i class="bi bi-cart"></i>
                @if(is_array(session('cart')))
                    <span class="cart-badge">{{ count(session('cart')) }}</span>
                @endif
            </a>

            @auth
            <div class="profile-wrapper">

                <div class="user-box">
                    <div class="user-icon">
                        {{ strtoupper(substr(Auth::user()->name ?? 'U',0,1)) }}
                    </div>
                    <div class="user-info">
                        <small>Halo,</small>
                        <strong>{{ Auth::user()->name }}</strong>
                    </div>
                </div>

                <div class="profile-dropdown">

                    <div class="profile-header">
                        <div class="profile-avatar">
                            {{ strtoupper(substr(Auth::user()->name ?? 'U',0,1)) }}
                        </div>
                        <div>
                            <strong>{{ Auth::user()->name }}</strong><br>
                            <small>{{ Auth::user()->email }}</small>
                        </div>
                    </div>

                    <a href="{{ route('profile') }}" class="dropdown-item">
                        <i class="bi bi-person"></i> Profil Saya
                    </a>

                    <a href="{{ route('orders.index') }}" class="dropdown-item">
                        <i class="bi bi-bag"></i> Pesanan Saya
                    </a>

                    <hr>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item text-danger">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>

                </div>

            </div>
            @endauth

            @guest
            <a href="{{ route('login') }}" class="nav-icon">
                <i class="bi bi-person"></i>
            </a>
            @endguest

        </div>

    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
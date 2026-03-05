@extends('layouts.app')

@section('content')

<style>
body {
    background-color: #F5EFE6;
    font-family: 'Poppins', sans-serif;
    color: #2F2A25;
}

/* HERO */
.hero-section {
    padding: 80px 0;
}

.badge-earth {
    background: #E8DFD0;
    color: #7A5C3E;
    padding: 8px 18px;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 500;
    display: inline-block;
}

.hero-title {
    font-size: 48px;
    font-weight: 700;
    margin: 20px 0;
}

.hero-text {
    font-size: 16px;
    color: #5C5248;
}

.btn-earth {
    background: #7A5C3E;
    color: #fff;
    padding: 12px 28px;
    border-radius: 12px;
    border: none;
    font-weight: 500;
    transition: 0.3s;
}

.btn-earth:hover {
    background: #4E3B2A;
    color: #fff;
}

.btn-outline-earth {
    border: 1px solid #CBBBA7;
    padding: 12px 28px;
    border-radius: 12px;
    background: #fff;
}

.hero-img {
    border-radius: 24px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.08);
    max-width: 500px;
    width: 100%;
}

/* PRODUCT */
.section-title {
    font-size: 36px;
    font-weight: 700;
}

.product-card {
    background: #fff;
    border-radius: 20px;
    padding: 20px;
    transition: 0.3s;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
}

.product-card:hover {
    transform: translateY(-8px);
}

.product-card img {
    width: 100%;
    border-radius: 14px;
}

.product-price {
    font-weight: 600;
    margin-top: 10px;
}

/* FEATURES */
.features {
    background: #E8DFD0;
    padding: 70px 0;
}

.feature-box {
    text-align: center;
}

.feature-icon {
    background: #7A5C3E;
    color: #fff;
    width: 70px;
    height: 70px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: auto;
    font-size: 28px;
}

/* ADMIN PANEL */
.admin-section {
    background: linear-gradient(135deg,#4E3B2A,#7A5C3E);
    color: #fff;
    padding: 50px;
    border-radius: 30px;
}

.btn-admin {
    background: #D97706;
    color: #fff;
    padding: 12px 30px;
    border-radius: 14px;
    border: none;
}
</style>

<div class="container hero-section">
    <div class="row align-items-center">
        <div class="col-md-6">
            <span class="badge-earth">Kualitas Premium Terjamin</span>

            <h1 class="hero-title">
                Furniture Kayu <br>
                Berkualitas untuk <br>
                Rumah Anda
            </h1>

            <p class="hero-text">
                Temukan koleksi lemari dan meja dari kayu jati dan mahoni
                berkualitas tinggi.
            </p>

            <div class="mt-4">
                <a href="{{ route('products.index') }}" class="btn-earth me-2">Lihat Koleksi</a>
                <a href="#" class="btn-outline-earth">Hubungi Kami</a>
            </div>
        </div>

        <div class="col-md-6 text-center">
            <!-- GAMBAR HERO -->
            <img src="{{ asset('images/lemari.jpg') }}" class="hero-img" alt="Furniture">
        </div>
    </div>
</div>


<!-- PRODUK UNGGULAN -->
<div class="container py-5">
    <h2 class="text-center section-title mb-5">Produk Unggulan</h2>

    <div class="row">
        @foreach($products->take(4) as $product)
        <div class="col-md-3 mb-4">
            <div class="product-card">
                <img src="{{ asset('images/'.$product->image) }}">
                <h6 class="mt-3">{{ $product->name }}</h6>
                <div class="product-price">
                    Rp {{ number_format($product->price,0,',','.') }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


<!-- FEATURES -->
<div class="features">
    <div class="container">
        <div class="row">
            <div class="col-md-4 feature-box">
                <div class="feature-icon">🚚</div>
                <h5 class="mt-3">Gratis Ongkir</h5>
                <p>Pembelian di atas Rp 5.000.000</p>
            </div>

            <div class="col-md-4 feature-box">
                <div class="feature-icon">🛡️</div>
                <h5 class="mt-3">Kualitas Terjamin</h5>
                <p>Material kayu premium terbaik</p>
            </div>

            <div class="col-md-4 feature-box">
                <div class="feature-icon">🎧</div>
                <h5 class="mt-3">Layanan 24/7</h5>
                <p>Customer service siap membantu</p>
            </div>
        </div>
    </div>
</div>


<!-- ADMIN PANEL -->
<div class="container my-5">
    <div class="admin-section d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <h3>Admin Panel</h3>
            <p>Kelola produk, pesanan, pelanggan & laporan</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="btn-admin">
            Akses Admin →
        </a>
    </div>
</div>

@endsection
{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('content')

@php
  $products = $products ?? \App\Models\Product::latest()->take(8)->get();
@endphp

{{-- ================= HERO ================= --}}
<section class="text-white py-5" style="
  background: radial-gradient(1200px circle at 10% 10%, rgba(255,193,7,.25), transparent 55%),
              radial-gradient(900px circle at 90% 30%, rgba(13,110,253,.18), transparent 50%),
              linear-gradient(180deg, #111827 0%, #0b1220 100%);
">
  <div class="container py-4">
    <div class="row align-items-center g-4">
      <div class="col-lg-7">
        <span class="badge rounded-pill mb-3" style="background:#f8f9fa;border:1px solid #e9ecef;color:#111827;">
          DDS Meubel • Furniture Berkualitas
        </span>

        <h1 class="display-5 fw-bold lh-sm mb-3">
          Buat rumah makin nyaman dengan <span class="text-warning">mebel terbaik</span>.
        </h1>

        <p class="lead text-white-50 mb-4">
          Pilihan lemari yang berkualitas.
        </p>

        <a href="{{ url('/products') }}" class="btn btn-light btn-lg rounded-pill px-4">
          Lihat Produk
        </a>
      </div>

      <div class="col-lg-5">
        <div class="rounded-4 p-4"
             style="background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.12);">
          <div class="text-center text-white-50">
            <div style="font-size:60px;">🪑</div>
            <div>Furniture Modern Minimalis</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ================= PRODUK ================= --}}
<section class="py-5 bg-light">
  <div class="container">
    <h3 class="fw-bold mb-4">Produk Unggulan</h3>

    <div class="row g-3">
      @forelse($products as $p)
      <div class="col-md-3">
        <div class="card shadow-sm h-100">
          <div class="card-body">
            <h6 class="fw-bold">{{ $p->name }}</h6>
            <div class="text-success fw-semibold">
              Rp {{ number_format($p->price,0,',','.') }}
            </div>
            <a href="{{ url('/products/'.$p->id) }}"
               class="btn btn-dark btn-sm mt-3 w-100">
              Detail
            </a>
          </div>
        </div>
      </div>
      @empty
      <div class="col-12">
        <div class="alert alert-warning">
          Produk belum tersedia.
        </div>
      </div>
      @endforelse
    </div>
  </div>
</section>

{{-- ================= LOGIN SECTION (CUSTOMER & ADMIN) ================= --}}
<style>
.login-section {
    background: linear-gradient(135deg, #0f1b2e, #1c2b45);
    padding: 100px 0;
}

.login-wrapper-box {
    background: linear-gradient(135deg, #1f2937, #2d1f1f);
    border-radius: 30px;
    padding: 60px;
    color: white;
    box-shadow: 0 0 60px rgba(255,140,0,0.15);
}

.login-card-item {
    background: rgba(255,255,255,0.05);
    border-radius: 20px;
    padding: 40px;
    transition: 0.3s ease;
    height: 100%;
}

.login-card-item:hover {
    transform: translateY(-8px);
    box-shadow: 0 0 40px rgba(255,140,0,0.4);
}

.login-icon {
    width: 80px;
    height: 80px;
    border-radius: 20px;
    background: linear-gradient(135deg, #ff9800, #ff6f00);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 35px;
    margin-bottom: 25px;
    box-shadow: 0 0 25px rgba(255,140,0,0.6);
}

.login-btn {
    background: linear-gradient(135deg, #ff9800, #ff6f00);
    color: white;
    padding: 14px 30px;
    border-radius: 15px;
    font-weight: bold;
    text-decoration: none;
    display: inline-block;
    margin-top: 20px;
    box-shadow: 0 0 25px rgba(255,140,0,0.6);
    transition: 0.3s ease;
}

.login-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 0 35px rgba(255,140,0,0.9);
    color: white;
}
</style>

<section class="login-section">
    <div class="container">
        <div class="login-wrapper-box">
            <div class="row g-4">

                {{-- CUSTOMER LOGIN --}}
                <div class="col-md-6">
                    <div class="login-card-item text-center">
                        <div class="login-icon">🛍</div>
                        <h2 class="fw-bold">Customer Login</h2>
                        <p>
                            Masuk untuk melihat pesanan dan mendapatkan promo eksklusif.
                        </p>
                        <a href="{{ route('login') }}" class="login-btn">
                            Masuk sebagai Customer →
                        </a>
                    </div>
                </div>

                {{-- ADMIN LOGIN --}}
                <div class="col-md-6">
                    <div class="login-card-item text-center">
                        <div class="login-icon">⚙</div>
                        <h2 class="fw-bold">Admin Login</h2>
                        <p>
                            Kelola produk, pesanan, pelanggan & laporan penjualan.
                        </p>
                        <a href="{{ route('login') }}" class="login-btn">
                            Masuk sebagai Admin →
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
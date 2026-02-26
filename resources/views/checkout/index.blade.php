@extends('layouts.app')

@section('content')

<style>
    body { background-color: #f4f6f9; }

    .checkout-title {
        font-weight: 700;
        font-size: 30px;
        margin-bottom: 20px;
    }

    .checkout-card {
        background: #ffffff;
        border-radius: 14px;
        padding: 25px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        margin-bottom: 20px;
    }

    .summary-card {
        background: #ffffff;
        border-radius: 14px;
        padding: 25px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        position: sticky;
        top: 100px;
    }

    .btn-order {
        background: #0d1b2a;
        color: white;
        border-radius: 12px;
        padding: 12px;
        font-weight: 600;
        border: none;
        transition: 0.3s;
    }

    .btn-order:hover {
        background: #1b263b;
    }

    /* RESPONSIVE RADIO */
    .payment-option {
        display: flex;
        align-items: center;
        gap: 10px;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 12px;
        margin-bottom: 10px;
        cursor: pointer;
        transition: 0.2s;
    }

    .payment-option:hover {
        background: #f8f9fa;
    }

    .payment-option input[type="radio"] {
        transform: scale(1.2);
    }
</style>

<div class="container mt-4">

    {{-- NAVIGASI --}}
    <div class="mb-3">
        <a href="{{ route('home') }}" class="text-decoration-none text-secondary">
            ← Beranda
        </a>
        <span class="mx-2">/</span>
        <a href="{{ route('cart.index') }}" class="text-decoration-none text-secondary">
            Keranjang
        </a>
        <span class="mx-2">/</span>
        <span class="fw-semibold">Checkout</span>
    </div>

    <div class="checkout-title">Checkout</div>

    @php
        $cart = session('cart', []);
        $total = 0;
    @endphp

    <div class="row">

        {{-- LEFT SIDE --}}
        <div class="col-lg-8">

            @if(!empty($cart))
            <form method="POST" action="#">
                @csrf

                {{-- Informasi Kontak --}}
                <div class="checkout-card">
                    <h5 class="fw-bold mb-3">Informasi Kontak</h5>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Nomor Telepon</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>
                </div>

                {{-- Alamat --}}
                <div class="checkout-card">
                    <h5 class="fw-bold mb-3">Alamat Pengiriman</h5>

                    <div class="mb-3">
                        <label>Alamat Lengkap</label>
                        <textarea name="address" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Kota</label>
                            <input type="text" name="city" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Kode Pos</label>
                            <input type="text" name="postal_code" class="form-control" required>
                        </div>
                    </div>
                </div>

                {{-- METODE PEMBAYARAN (RESPONSIF FIX) --}}
                <div class="checkout-card">
                    <h5 class="fw-bold mb-3">Metode Pembayaran</h5>

                    <label class="payment-option w-100">
                        <input type="radio" name="payment" value="transfer" class="form-check-input" checked>
                        Transfer Bank
                    </label>

                    <label class="payment-option w-100">
                        <input type="radio" name="payment" value="cod" class="form-check-input">
                        COD (Cash on Delivery)
                    </label>

                    <label class="payment-option w-100">
                        <input type="radio" name="payment" value="ewallet" class="form-check-input">
                        E-Wallet
                    </label>
                </div>

            </form>
            @else
                <div class="checkout-card">
                    <p class="text-muted">Keranjang kosong. Silakan belanja dulu.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-dark">
                        Lihat Produk
                    </a>
                </div>
            @endif

        </div>

        {{-- RIGHT SIDE --}}
        <div class="col-lg-4">
            <div class="summary-card">

                <h5 class="fw-bold mb-3">Ringkasan Pesanan</h5>

                @if(!empty($cart))

                    <div style="max-height:200px; overflow-y:auto;">
                        @foreach($cart as $item)
                            @php
                                $subtotal = $item['quantity'] * $item['price'];
                                $total += $subtotal;
                            @endphp

                            <div class="d-flex justify-content-between mb-2">
                                <small>{{ $item['name'] }} x{{ $item['quantity'] }}</small>
                                <small>Rp {{ number_format($subtotal,0,',','.') }}</small>
                            </div>
                        @endforeach
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($total,0,',','.') }}</span>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span>Ongkir</span>
                        <span>GRATIS</span>
                    </div>

                    <div class="d-flex justify-content-between fw-bold mt-2">
                        <span>Total</span>
                        <span>Rp {{ number_format($total,0,',','.') }}</span>
                    </div>

                    <button class="btn btn-order w-100 mt-3">
                        Buat Pesanan
                    </button>

                @else
                    <p class="text-muted">Tidak ada pesanan.</p>
                @endif

            </div>
        </div>

    </div>
</div>

@endsection
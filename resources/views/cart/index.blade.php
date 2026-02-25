{{-- resources/views/cart/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-4">
    {{-- Header --}}
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4">
        <div>
            <h2 class="fw-bold mb-1">Keranjang Belanja</h2>
            <p class="text-muted mb-0">Cek kembali produk kamu sebelum checkout.</p>
        </div>
        <div class="mt-3 mt-md-0 d-flex gap-2">
            <a href="{{ url('/') }}" class="btn btn-outline-secondary rounded-pill px-3">
                ← Lanjut Belanja
            </a>
            <a href="#" class="btn btn-dark rounded-pill px-3">
                Checkout
            </a>
        </div>
    </div>

    @php
        // Asumsi keranjang disimpan di session sebagai array
        $cart = session('cart', []);
        $items = is_array($cart) ? $cart : [];
        $subtotal = 0;
        foreach ($items as $it) {
            $qty = (int)($it['quantity'] ?? 1);
            $price = (int)($it['price'] ?? 0);
            $subtotal += ($qty * $price);
        }
        $shipping = $subtotal > 0 ? 0 : 0; // bisa kamu ubah misal flat 25000
        $discount = 0;
        $total = $subtotal + $shipping - $discount;
    @endphp

    @if(empty($items))
        {{-- Empty state --}}
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-body p-5 text-center">
                        <div class="mx-auto mb-3" style="width:84px;height:84px;border-radius:24px;background:#f3f4f6;display:flex;align-items:center;justify-content:center;">
                            <span style="font-size:34px;">🛒</span>
                        </div>
                        <h4 class="fw-bold mb-2">Keranjang kamu masih kosong</h4>
                        <p class="text-muted mb-4">
                            Yuk pilih mebel favoritmu dulu. Nanti produk yang kamu pilih akan muncul di sini.
                        </p>

                        <div class="d-flex flex-column flex-sm-row gap-2 justify-content-center">
                            <a href="{{ url('/') }}" class="btn btn-dark rounded-pill px-4 py-2">
                                Mulai Belanja
                            </a>
                            <a href="{{ url('/products') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                                Lihat Produk
                            </a>
                        </div>

                        <div class="mt-4 pt-4 border-top text-muted small">
                            Tip: Tambahkan produk, lalu atur jumlahnya di keranjang sebelum checkout.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row g-4">
            {{-- List items --}}
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-0">
                        <div class="p-4 border-bottom">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="fw-semibold">Produk di Keranjang</div>
                                <span class="badge bg-light text-dark rounded-pill">
                                    {{ count($items) }} item
                                </span>
                            </div>
                        </div>

                        <div class="p-4">
                            @foreach($items as $id => $item)
                                @php
                                    $name = $item['name'] ?? 'Produk';
                                    $price = (int)($item['price'] ?? 0);
                                    $qty = (int)($item['quantity'] ?? 1);
                                    $lineTotal = $price * $qty;

                                    // opsional: image path
                                    $image = $item['image'] ?? null; // contoh: 'products/abc.jpg'
                                @endphp

                                <div class="d-flex gap-3 align-items-start py-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                                    {{-- Thumbnail --}}
                                    <div class="flex-shrink-0">
                                        <div class="rounded-4 overflow-hidden border" style="width:90px;height:90px;background:#f8f9fa;display:flex;align-items:center;justify-content:center;">
                                            @if($image)
                                                <img src="{{ asset('storage/'.$image) }}" alt="{{ $name }}" style="width:100%;height:100%;object-fit:cover;">
                                            @else
                                                <span style="font-size:28px;">🪑</span>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Info --}}
                                    <div class="flex-grow-1">
                                        <div class="d-flex flex-column flex-md-row justify-content-between gap-2">
                                            <div>
                                                <div class="fw-bold">{{ $name }}</div>
                                                <div class="text-muted small">Harga: Rp {{ number_format($price, 0, ',', '.') }}</div>
                                            </div>
                                            <div class="text-md-end">
                                                <div class="fw-bold">Rp {{ number_format($lineTotal, 0, ',', '.') }}</div>
                                                <div class="text-muted small">Total item</div>
                                            </div>
                                        </div>

                                        {{-- Actions --}}
                                        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2 mt-3">
                                            {{-- Qty controls (kamu bisa sambungkan ke route update qty) --}}
                                            <div class="d-inline-flex align-items-center gap-2">
                                                <span class="text-muted small">Qty</span>

                                                <div class="input-group input-group-sm" style="width:140px;">
                                                    <form action="{{ route('cart.decrease', $id) }}" method="POST">
                                                        @csrf
                                                        <button class="btn btn-outline-secondary" type="submit">-</button>
                                                    </form>

                                                    <input type="text" class="form-control text-center" value="{{ $qty }}" readonly>

                                                    <form action="{{ route('cart.increase', $id) }}" method="POST">
                                                        @csrf
                                                        <button class="btn btn-outline-secondary" type="submit">+</button>
                                                    </form>
                                                </div>
                                            </div>

                                            <div class="d-flex gap-2">
                                                {{-- Remove --}}
                                                <form action="{{ route('cart.remove', $id) }}" method="POST" onsubmit="return confirm('Hapus item ini dari keranjang?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Footer actions --}}
                        <div class="p-4 border-top d-flex flex-column flex-md-row gap-2 justify-content-between">
                            <a href="{{ url('/products') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                + Tambah Produk Lagi
                            </a>

                            <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Kosongkan keranjang?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-dark rounded-pill px-4">
                                    Kosongkan Keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Summary --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="fw-bold">Ringkasan</div>
                            <span class="badge bg-dark rounded-pill">Aman</span>
                        </div>

                        <div class="d-flex justify-content-between text-muted mb-2">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between text-muted mb-2">
                            <span>Ongkir</span>
                            <span>{{ $shipping == 0 ? 'Gratis' : 'Rp '.number_format($shipping, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between text-muted mb-3">
                            <span>Diskon</span>
                            <span>Rp {{ number_format($discount, 0, ',', '.') }}</span>
                        </div>

                        <div class="border-top pt-3 d-flex justify-content-between align-items-center">
                            <span class="fw-semibold">Total</span>
                            <span class="fw-bold fs-5">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        <div class="mt-4 d-grid gap-2">
                            <a href="#" class="btn btn-dark rounded-pill py-2">
                                Checkout Sekarang
                            </a>
                            <small class="text-muted text-center">
                                Dengan checkout, kamu menyetujui syarat & ketentuan.
                            </small>
                        </div>

                        {{-- Promo code (opsional) --}}
                        <div class="mt-4 p-3 rounded-4" style="background:#f8f9fa;">
                            <div class="fw-semibold mb-2">Kode Promo</div>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Masukkan kode...">
                                <button class="btn btn-outline-dark" type="button">Pakai</button>
                            </div>
                            <div class="text-muted small mt-2">*Opsional, bisa kamu sambungkan nanti.</div>
                        </div>
                    </div>
                </div>

                {{-- Trust badges --}}
                <div class="mt-3 d-flex gap-2 flex-wrap">
                    <span class="badge bg-light text-dark border rounded-pill px-3 py-2">✅ Produk berkualitas</span>
                    <span class="badge bg-light text-dark border rounded-pill px-3 py-2">🚚 Pengiriman aman</span>
                    <span class="badge bg-light text-dark border rounded-pill px-3 py-2">🔒 Pembayaran aman</span>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width: 800px;">

    {{-- ICON + TITLE --}}
    <div class="text-center mb-4">
        <div class="mb-3">
            <i class="bi bi-check-circle-fill text-success" style="font-size: 60px;"></i>
        </div>
        <h2 class="fw-bold">Terima Kasih!</h2>
        <p class="text-muted">Pesanan Anda berhasil dibuat</p>
    </div>

    {{-- ORDER NUMBER --}}
    <div class="card border-0 shadow-sm mb-4 text-center p-3"
         style="border-radius: 12px; background:#fff8e5;">
        <small class="text-muted">Nomor Pesanan</small>
        <h5 class="fw-bold mb-0">{{ $order->order_number }}</h5>
        <small>{{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('d F Y \p\u\k\u\l H.i') }}</small>
    </div>

    {{-- STATUS --}}
    <div class="card border-0 mb-4 p-3 text-white"
         style="background:#f97316; border-radius:12px;">
        <div class="fw-bold mb-1">
            <i class="bi bi-clock me-2"></i>Status Pesanan
        </div>
        <div>{{ ucfirst($order->status) }}</div>
        <small>Silakan lakukan pembayaran sesuai metode yang Anda pilih.</small>
    </div>

    {{-- PEMBAYARAN --}}
    <div class="card shadow-sm border-0 mb-4 p-3" style="border-radius:12px;">
        <div class="fw-bold mb-3">
            <i class="bi bi-credit-card me-2"></i>Informasi Pembayaran
        </div>

        <div class="border rounded p-2 mb-2 d-flex justify-content-between">
            <div>
                <strong>BCA</strong><br>
                <small>DDS Meubel</small>
            </div>
            <div>1234567890</div>
        </div>

        <div class="border rounded p-2 mb-2 d-flex justify-content-between">
            <div>
                <strong>Mandiri</strong><br>
                <small>DDS Meubel</small>
            </div>
            <div>087654321</div>
        </div>

        <div class="border rounded p-2 mb-3 d-flex justify-content-between">
            <div>
                <strong>BNI</strong><br>
                <small>DDS Meubel</small>
            </div>
            <div>555666677</div>
        </div>

        <div class="d-flex justify-content-between">
            <strong>Total Pembayaran:</strong>
            <strong class="text-danger">
                Rp {{ number_format($order->total,0,',','.') }}
            </strong>
        </div>
    </div>

    {{-- DETAIL PRODUK --}}
    <div class="card shadow-sm border-0 mb-4 p-3" style="border-radius:12px;">
        <div class="fw-bold mb-3">
            <i class="bi bi-box me-2"></i>Detail Pesanan
        </div>

        <div class="d-flex align-items-center gap-3">
            <div style="width:60px;height:60px;background:#eee;border-radius:10px;overflow:hidden;">
                @if($order->product && $order->product->image)
                    <img src="{{ asset('storage/'.$order->product->image) }}"
                         style="width:100%;height:100%;object-fit:cover;">
                @endif
            </div>

            <div class="flex-grow-1">
                <strong>{{ $order->product->name ?? '-' }}</strong><br>
                <small>Jumlah: {{ $order->quantity }}</small>
            </div>

            <div>
                Rp {{ number_format($order->total,0,',','.') }}
            </div>
        </div>
    </div>

    {{-- INFORMASI PENGIRIMAN --}}
    <div class="card shadow-sm border-0 mb-4 p-3" style="border-radius:12px;">
        <div class="fw-bold mb-3">
            <i class="bi bi-geo-alt me-2"></i>Informasi Pengiriman
        </div>

        <p class="mb-1"><strong>{{ $order->customer_name }}</strong></p>
        <p class="mb-1">{{ $order->phone }}</p>
        <p class="mb-1">{{ $order->email }}</p>
        <p class="mb-0">
            {{ $order->address }}, {{ $order->city }}, {{ $order->postal_code }}
        </p>
    </div>

    {{-- BUTTON --}}
    <div class="d-flex gap-3">
        <a href="{{ route('orders.index') }}"
           class="btn btn-warning flex-fill fw-bold">
            Lihat Pesanan Saya
        </a>

        <a href="{{ route('home') }}"
           class="btn btn-outline-secondary flex-fill">
            Kembali ke Beranda
        </a>
    </div>

</div>
@endsection
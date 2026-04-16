@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold mb-4" style="font-size: 2.2rem; color: #2F2A25;">Pesanan Saya</h2>

    {{-- ================= PESANAN BIASA ================= --}}
    @if($orders->count() > 0)
        @foreach($orders as $order)
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 24px; overflow: hidden;">
                
                {{-- HEADER --}}
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-start gap-3 p-4 border-bottom"
                     style="border-color: #E5E7EB !important;">
                    <div>
                        <p class="mb-1" style="font-size: 16px; color: #374151;">
                            Order ID:
                            <strong>#{{ $order->order_number ?? $order->id }}</strong>
                        </p>
                        <p class="mb-0" style="font-size: 16px; color: #374151;">
                            Tanggal:
                            {{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('d F Y \p\u\k\u\l H.i') }}
                        </p>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <div class="d-flex align-items-center justify-content-center"
                             style="width: 38px; height: 38px; border: 2px solid #E6A800; border-radius: 50%; color: #E6A800; font-size: 16px;">
                            <i class="bi bi-clock"></i>
                        </div>

                        <span class="px-4 py-2 fw-semibold"
                              style="background: #F8E9A8; color: #8A6500; border-radius: 999px; font-size: 15px;">
                            {{ ucfirst($order->status ?? 'Menunggu pembayaran') }}
                        </span>
                    </div>
                </div>

                {{-- BODY --}}
                <div class="p-4">
                    <div class="row g-3 align-items-start">
                        <div class="col-12 col-sm-auto">
                            <div class="d-flex align-items-center justify-content-center"
                                 style="width: 92px; height: 92px; background: #F3F4F6; border-radius: 18px; overflow: hidden;">
                                @if(!empty($order->product->image))
                                    <img src="{{ asset('storage/' . $order->product->image) }}"
                                         alt="{{ $order->product->name }}"
                                         style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <i class="bi bi-image text-secondary" style="font-size: 42px;"></i>
                                @endif
                            </div>
                        </div>

                        <div class="col">
                            <h4 class="fw-semibold mb-1" style="font-size: 1.8rem; color: #1F2937;">
                                {{ $order->product->name ?? 'Produk Tidak Ditemukan' }}
                            </h4>
                            <p class="mb-1" style="font-size: 16px; color: #4B5563;">
                                Jumlah: {{ $order->quantity ?? 1 }}
                            </p>
                            <p class="mb-0 fw-bold" style="font-size: 18px; color: #1F2937;">
                                Rp {{ number_format($order->product->price ?? $order->total ?? 0, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    {{-- TOTAL --}}
                    <div class="d-flex justify-content-between align-items-center mt-4 pt-4 border-top"
                         style="border-color: #E5E7EB !important;">
                        <h5 class="fw-semibold mb-0" style="font-size: 1.6rem; color: #1F2937;">
                            Total Pesanan
                        </h5>
                        <h4 class="fw-bold mb-0 text-end" style="font-size: 2rem; color: #111827;">
                            Rp {{ number_format($order->total, 0, ',', '.') }}
                        </h4>
                    </div>

                    {{-- INFO --}}
                    <div class="mt-4 p-4"
                         style="background: #F9FAFB; border-radius: 18px;">
                        <p class="mb-2" style="font-size: 16px; color: #374151;">
                            <strong>Alamat Pengiriman:</strong>
                            {{ $order->address ?? $order->shipping_address ?? '-' }}
                        </p>
                        <p class="mb-0" style="font-size: 16px; color: #374151;">
                            <strong>Metode Pembayaran:</strong>
                            {{ $order->payment_method ?? 'Transfer Bank' }}
                        </p>
                    </div>

                    {{-- DETAIL BUTTON --}}
                    <div class="mt-4">
                        <a href="{{ route('orders.show', $order->id) }}"
                           class="btn btn-primary px-4 py-2 rounded-pill fw-semibold">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="alert alert-info rounded-4 shadow-sm border-0">
            Belum ada pesanan.
        </div>
    @endif

    {{-- ================= PESANAN CUSTOM ================= --}}
    @if(isset($customOrders) && $customOrders->count() > 0)
        <h4 class="fw-bold mt-5 mb-3" style="color: #2F2A25;">Pesanan Custom</h4>

        @foreach($customOrders as $order)
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 24px; overflow: hidden;">
                <div class="p-4">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-start gap-3">
                        <div>
                            <p class="mb-1" style="font-size: 16px; color: #374151;">
                                <strong>Nama:</strong> {{ $order->name }}
                            </p>
                            <p class="mb-0" style="font-size: 16px; color: #374151;">
                                Tanggal: {{ $order->created_at->format('d-m-Y') }}
                            </p>
                        </div>

                        <span class="px-4 py-2 fw-semibold"
                              style="background: #E5E7EB; color: #374151; border-radius: 999px; font-size: 15px;">
                            {{ $order->status ?? 'Menunggu' }}
                        </span>
                    </div>

                    <div class="mt-3">
                        <p class="mb-1"><strong>Material:</strong> {{ $order->material }}</p>
                        <p class="mb-0"><strong>Ukuran:</strong> {{ $order->size }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
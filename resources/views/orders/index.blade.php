@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2 class="mb-4 fw-bold">Pesanan Saya</h2>

    @if($order)

    <div class="card shadow-sm rounded-4 p-4">

        <div class="d-flex justify-content-between align-items-center">
            <div>
                <p class="mb-1">Order ID: <strong>{{ $order['order_id'] }}</strong></p>
                <p class="mb-0">Tanggal: {{ $order['date'] }}</p>
            </div>

            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                {{ $order['status'] }}
            </span>
        </div>

        <hr>

        @foreach($order['items'] as $item)
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h6 class="mb-1">{{ $item['name'] }}</h6>
                <small>Jumlah: {{ $item['quantity'] }}</small>
            </div>
            <div>
                Rp {{ number_format($item['price'] * $item['quantity'],0,',','.') }}
            </div>
        </div>
        @endforeach

        <hr>

        <div class="d-flex justify-content-between fw-bold">
            <span>Total Pesanan</span>
            <span>Rp {{ number_format($order['total'],0,',','.') }}</span>
        </div>

        <div class="mt-3 p-3 bg-light rounded-3">
            <p class="mb-1"><strong>Alamat Pengiriman:</strong> {{ $order['address'] }}</p>
            <p class="mb-0"><strong>Metode Pembayaran:</strong> {{ $order['payment'] }}</p>
        </div>

    </div>

    @else

        <div class="alert alert-info">
            Belum ada pesanan.
        </div>

    @endif

</div>

@endsection
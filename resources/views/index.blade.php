@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h3 class="fw-bold mb-4">Pesanan Saya</h3>

    @if($order)

    <div class="card p-4 shadow-sm rounded-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <div><strong>Order ID:</strong> {{ $order['order_id'] }}</div>
                <div><strong>Tanggal:</strong> {{ $order['date'] }}</div>
            </div>

            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                {{ $order['status'] }}
            </span>
        </div>

        <hr>

        @foreach($order['items'] as $item)
        <div class="d-flex justify-content-between mb-2">
            <div>
                {{ $item['name'] }} <br>
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

        <div class="mt-3 p-3 bg-light rounded">
            <div><strong>Alamat Pengiriman:</strong> {{ $order['address'] }}</div>
            <div><strong>Metode Pembayaran:</strong> {{ ucfirst($order['payment']) }}</div>
        </div>

    </div>

    @else
        <p>Tidak ada pesanan.</p>
    @endif

</div>

@endsection
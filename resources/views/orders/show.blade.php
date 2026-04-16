@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 fw-bold">Detail Pesanan</h2>

    <div class="card shadow-sm rounded-4 p-4">
        <p><strong>Order ID:</strong> {{ $order->id }}</p>
        <p><strong>Tanggal:</strong> {{ $order->created_at->format('d-m-Y') }}</p>
        <p><strong>Status:</strong> {{ $order->status }}</p>

        <hr>

        <p><strong>Nama:</strong> {{ $order->customer_name }}</p>
        <p><strong>Email:</strong> {{ $order->email }}</p>
        <p><strong>Telepon:</strong> {{ $order->phone }}</p>
        <p><strong>Alamat:</strong> {{ $order->address }}</p>
        <p><strong>Kota:</strong> {{ $order->city }}</p>
        <p><strong>Kode Pos:</strong> {{ $order->postal_code }}</p>

        <hr>

        <p><strong>Total:</strong> Rp {{ number_format($order->total, 0, ',', '.') }}</p>

        <a href="{{ route('orders.index') }}" class="btn btn-secondary mt-3">
            Kembali
        </a>
    </div>
</div>
@endsection
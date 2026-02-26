@extends('layouts.admin')

@section('content')

<h2 class="mb-4 fw-bold">Dashboard Admin</h2>

<div class="row g-4">

    <div class="col-md-4">
        <div class="card-stat shadow-sm">
            <h3>5</h3>
            <p class="text-muted mb-0">Total Produk</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-stat shadow-sm">
            <h3>0</h3>
            <p class="text-muted mb-0">Total Pesanan</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-stat shadow-sm">
            <h3>0</h3>
            <p class="text-muted mb-0">Total Pelanggan</p>
        </div>
    </div>

</div>

<div class="mt-5">
    <div class="card shadow-sm">
        <div class="card-header fw-bold">
            Pesanan Terbaru
        </div>
        <div class="card-body text-center text-muted">
            Belum ada pesanan
        </div>
    </div>
</div>

@endsection
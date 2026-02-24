@extends('layouts.app')

@section('content')
<div class="text-center">
    <h1>Selamat Datang di DDS Meubel</h1>
    <p>Toko furniture berkualitas dengan harga terbaik.</p>
    <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">
        Lihat Produk
    </a>
</div>
@endsection
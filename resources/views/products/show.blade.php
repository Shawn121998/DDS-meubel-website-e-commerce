@extends('layouts.app')

@section('content')

<div class="container mt-4">

@if(session('success'))

<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

<div class="row">

{{-- GAMBAR PRODUK --}}

<div class="col-md-6">
<img src="{{ $product->image ? asset('images/'.$product->image) : 'https://via.placeholder.com/400' }}"
class="img-fluid rounded shadow-sm"
style="width:100%; max-height:420px; object-fit:cover;">
</div>

{{-- DETAIL PRODUK --}}

<div class="col-md-6">

<h2 class="fw-bold">{{ $product->name }}</h2>

<p class="text-success fs-4 fw-bold">
Rp {{ number_format($product->price, 0, ',', '.') }}
</p>

<p><strong>Ukuran:</strong> {{ $product->size ?? '-' }}</p>
<p><strong>Bahan:</strong> {{ $product->material ?? '-' }}</p>
<p><strong>Stok:</strong> {{ $product->stock }}</p>

<p class="mt-3">{{ $product->description }}</p>

{{-- Tombol Keranjang + Wishlist --}}

<div class="d-flex gap-2 mt-3">

<form action="{{ route('cart.add', $product->id) }}" method="POST">
@csrf
<button type="submit" class="btn btn-success">
Tambah ke Keranjang
</button>
</form>

<form action="{{ route('wishlist.add', $product->id) }}" method="POST">
@csrf
<button type="submit" class="btn btn-outline-danger">
❤️ Wishlist
</button>
</form>

</div>

{{-- Tombol Kembali --}} <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">
Kembali </a>

</div>
</div>

<hr class="mt-5">

<h4>Ulasan Produk</h4>

@if(auth()->check())

<form action="{{ route('review.store') }}" method="POST">
@csrf

<input type="hidden" name="product_id" value="{{ $product->id }}">

<div class="mb-3">
<label>Rating</label>
<select name="rating" class="form-control">
<option value="5">⭐⭐⭐⭐⭐</option>
<option value="4">⭐⭐⭐⭐</option>
<option value="3">⭐⭐⭐</option>
<option value="2">⭐⭐</option>
<option value="1">⭐</option>
</select>
</div>

<div class="mb-3">
<label>Komentar</label>
<textarea name="comment" class="form-control"></textarea>
</div>

<button class="btn btn-primary">
Kirim Ulasan
</button>

</form>

@else

<p>Silakan login untuk memberi ulasan.</p>

@endif

</div>

@endsection

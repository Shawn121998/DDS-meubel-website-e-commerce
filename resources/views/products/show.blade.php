@extends('layouts.app')

@section('content')
<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <img src="{{ $product->image ?? 'https://via.placeholder.com/400' }}" 
                 class="img-fluid rounded shadow-sm">
        </div>

        <div class="col-md-6">
            <h2>{{ $product->name }}</h2>

            <p class="text-success fs-4 fw-bold">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </p>

            <p><strong>Ukuran:</strong> {{ $product->size ?? '-' }}</p>
            <p><strong>Bahan:</strong> {{ $product->material ?? '-' }}</p>
            <p><strong>Stok:</strong> {{ $product->stock }}</p>

            <p class="mt-3">{{ $product->description }}</p>

            {{-- Tombol Tambah ke Keranjang (FIX POST) --}}
            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-success">
                    Tambah ke Keranjang
                </button>
            </form>

            {{-- Tombol Kembali --}}
            <a href="{{ route('products.index') }}" 
               class="btn btn-secondary mt-3">
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection
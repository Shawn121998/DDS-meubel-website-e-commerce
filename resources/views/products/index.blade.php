@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Daftar Produk</h2>

    <div class="row">
        @forelse($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ $product->image ?? 'https://via.placeholder.com/300' }}" 
                         class="card-img-top" 
                         style="height:200px; object-fit:cover;">

                    <div class="card-body">
                        <h5>{{ $product->name }}</h5>
                        <p class="text-success fw-bold">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>

                        <a href="{{ route('products.show', $product->slug) }}" 
                           class="btn btn-primary btn-sm">
                            Detail
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p>Belum ada produk.</p>
        @endforelse
    </div>

    <div class="mt-3">
        {{ $products->links() }}
    </div>
</div>
@endsection
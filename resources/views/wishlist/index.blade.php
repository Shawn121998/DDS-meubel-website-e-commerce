@extends('layouts.app')

@section('content')

<div class="container mt-4">

<h2 class="mb-4">Wishlist Saya</h2>

@if($wishlists->count() > 0)

<div class="row">

@foreach($wishlists as $wishlist)

<div class="col-md-3 mb-4">

<div class="card h-100 shadow-sm">

<img src="{{ asset('images/'.$wishlist->product->image) }}" 
class="card-img-top" 
style="height:200px; object-fit:cover;">

<div class="card-body">

<h5>{{ $wishlist->product->name }}</h5>

<p class="text-success fw-bold">
Rp {{ number_format($wishlist->product->price,0,',','.') }}
</p>

<a href="{{ route('products.show', $wishlist->product->slug) }}" 
class="btn btn-primary btn-sm">
Lihat Produk
</a>

</div>

</div>

</div>

@endforeach

</div>

@else

<p>Wishlist masih kosong.</p>

@endif

</div>

@endsection
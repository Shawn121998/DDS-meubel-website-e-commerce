@extends('layouts.app')

@section('content')

<style>

body{
background:#f5f5f5;
}

/* HERO */

.hero-produk{
background:#d45a00;
color:white;
text-align:center;
padding:70px 0;
}

.hero-produk h1{
font-weight:700;
font-size:42px;
}

.hero-produk p{
opacity:0.9;
}

/* FILTER */

.filter-box{
background:white;
padding:25px;
border-radius:14px;
box-shadow:0 6px 15px rgba(0,0,0,0.08);
margin-top:-40px;
}

/* CARD PRODUK */

.product-card{
background:white;
border-radius:14px;
overflow:hidden;
box-shadow:0 4px 10px rgba(0,0,0,0.08);
transition:0.3s;
}

.product-card:hover{
transform:translateY(-5px);
}

.product-image{
height:200px;
background:#eaeaea;
display:flex;
align-items:center;
justify-content:center;
}

.product-image img{
width:100%;
height:100%;
object-fit:cover;
}

.badge-stock{
position:absolute;
top:10px;
left:10px;
background:#ff4d4f;
color:white;
font-size:12px;
padding:4px 10px;
border-radius:20px;
}

.rating{
position:absolute;
top:10px;
right:10px;
background:white;
padding:4px 10px;
border-radius:20px;
font-size:12px;
box-shadow:0 3px 6px rgba(0,0,0,0.1);
}

.product-body{
padding:16px;
}

.category{
font-size:12px;
color:#ff7a00;
font-weight:600;
letter-spacing:1px;
}

.product-title{
font-weight:600;
margin:6px 0;
}

.price{
font-weight:700;
font-size:18px;
}

.stock{
font-size:12px;
color:#777;
}

.btn-arrow{
width:36px;
height:36px;
border-radius:50%;
background:#ffe5c2;
display:flex;
align-items:center;
justify-content:center;
font-weight:700;
}

</style>



{{-- HERO --}}
<section class="hero-produk">

<div class="container">

<h1>Katalog Produk</h1>

<p>DDS meubel menyediakan berbagai macam produk untuk keperluan keluarga anda!</p>

</div>

</section>



<div class="container mt-4">


{{-- FILTER --}}
<div class="filter-box mb-4">

<div class="row">

<div class="col-md-6">

<label>Kategori</label>

<select class="form-control">
<option>Semua</option>
<option>Lemari</option>
<option>Kursi</option>
<option>Meja</option>
</select>

</div>


<div class="col-md-6">

<label>Urutkan</label>

<select class="form-control">
<option>Nama (A-Z)</option>
<option>Harga Terendah</option>
<option>Harga Tertinggi</option>
</select>

</div>

</div>

</div>


<p>Menampilkan {{ $products->count() }} produk</p>


<div class="row">

@foreach($products as $product)

<div class="col-md-3 mb-4">

<div class="product-card position-relative">


<span class="badge-stock">
Stok Terbatas
</span>

<span class="rating">
⭐ 4.9
</span>


<div class="product-image">

@if($product->image)

<img src="{{ asset('images/'.$product->image) }}">

@else

<img src="https://via.placeholder.com/300x200">

@endif

</div>


<div class="product-body">

<div class="category">
LEMARI
</div>

<div class="product-title">
{{ $product->name }}
</div>

<div style="font-size:12px;color:#777">
⭐ 4.9 (0 ulasan)
</div>


<div class="d-flex justify-content-between align-items-center mt-2">

<div>

<div class="price">
Rp {{ number_format($product->price,0,',','.') }}
</div>

<div class="stock">
Stok: {{ $product->stock ?? 0 }}
</div>

</div>


<a href="{{ route('products.show',$product->id) }}" class="btn-arrow">
>
</a>

</div>

</div>

</div>

</div>

@endforeach

</div>

</div>

@endsection
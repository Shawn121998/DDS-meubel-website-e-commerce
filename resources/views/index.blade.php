@extends('layouts.app')

@section('content')

<style>
/* HEADER */
.catalog-header {
    background: #7A5C3E;
    padding: 60px 0;
    text-align: center;
    color: white;
}

.catalog-header h1 {
    font-weight: 700;
}

/* FILTER BOX */
.filter-box {
    background: #fff;
    padding: 25px;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    margin-top: -30px;
}

/* PRODUCT CARD */
.product-card {
    background: #fff;
    border-radius: 20px;
    padding: 20px;
    transition: 0.3s;
    box-shadow: 0 8px 20px rgba(0,0,0,0.05);
    position: relative;
}

.product-card:hover {
    transform: translateY(-8px);
}

.product-img {
    height: 180px;
    background: #E8DFD0;
    border-radius: 15px;
    margin-bottom: 15px;
}

.product-category {
    font-size: 12px;
    color: #7A5C3E;
    font-weight: 600;
}

.product-price {
    font-weight: 700;
    font-size: 18px;
}

.stock-label {
    font-size: 12px;
    color: gray;
}

.rating-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: #F5EFE6;
    padding: 4px 10px;
    border-radius: 50px;
    font-size: 12px;
}
</style>

<!-- HEADER -->
<div class="catalog-header">
    <h1>Katalog Produk</h1>
    <p>DDS Meubel menyediakan berbagai macam produk untuk keperluan keluarga anda</p>
</div>

<div class="container">

    <!-- FILTER -->
    <div class="filter-box">
        <div class="row">
            <div class="col-md-6">
                <label>Kategori</label>
                <select class="form-select">
                    <option>Semua</option>
                    <option>Lemari</option>
                    <option>Meja</option>
                    <option>Kursi</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Urutkan</label>
                <select class="form-select">
                    <option>Nama (A-Z)</option>
                    <option>Harga Terendah</option>
                    <option>Harga Tertinggi</option>
                </select>
            </div>
        </div>
    </div>

    <p class="mt-4">Menampilkan {{ $products->count() }} produk</p>

    <!-- PRODUCT GRID -->
    <div class="row mt-3">
        @foreach($products as $product)
        <div class="col-md-3 mb-4">
            <div class="product-card">

                <div class="rating-badge">
                    ⭐ 4.8
                </div>

                <div class="product-img"></div>

                <div class="product-category">LEMARI</div>

                <h6 class="mt-2">{{ $product->name }}</h6>

                <div class="product-price">
                    Rp {{ number_format($product->price,0,',','.') }}
                </div>

                <div class="stock-label">
                    Stok: {{ $product->stock ?? 10 }}
                </div>

            </div>
        </div>
        @endforeach
    </div>

</div>

@endsection
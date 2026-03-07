@extends('layouts.admin')

@section('content')

<div class="container-fluid">

<h2 class="mb-4">Manajemen Produk</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Gambar</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stok</th>
        </tr>
    </thead>

    <tbody>
        @foreach($products as $product)

        <tr>
            <td>{{ $product->id }}</td>

            <td>
                <img src="{{ asset('images/'.$product->image) }}" width="60">
            </td>

            <td>{{ $product->name }}</td>

            <td>Rp {{ number_format($product->price) }}</td>

            <td>{{ $product->stock }}</td>

        </tr>

        @endforeach
    </tbody>

</table>

</div>

@endsection
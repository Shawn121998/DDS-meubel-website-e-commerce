@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <h2>Manajemen Produk</h2>
    <p>Halaman ini untuk mengelola produk DDS Meubel.</p>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Contoh Produk</td>
                <td>Rp 1.000.000</td>
                <td>Edit | Hapus</td>
            </tr>
        </tbody>
    </table>
</div>

@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Dashboard Admin</h2>

    <div style="display:flex; gap:20px; margin-top:20px;">
        <div style="background:#f8f9fa; padding:20px; border-radius:8px;">
            <h4>Total Produk</h4>
            <h2>{{ $totalProduk }}</h2>
        </div>

        <div style="background:#f8f9fa; padding:20px; border-radius:8px;">
            <h4>Total User</h4>
            <h2>{{ $totalUser }}</h2>
        </div>
    </div>
</div>
@endsection
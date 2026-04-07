@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h2 class="mb-4">Manajemen Produk</h2>

    <!-- Tombol Tambah -->
    <a href="{{ route('produk.create') }}" class="btn btn-dark mb-3">
        + Tambah Produk
    </a>

    <!-- Table Responsive -->
    <div class="table-responsive">

        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Gambar</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Unggulan</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($products as $product)

                <tr>
                    <td>{{ $product->id }}</td>

                    <td>
                        <img src="{{ asset('images/'.$product->image) }}" width="70">
                    </td>

                    <td>{{ $product->name }}</td>

                    <td>Rp {{ number_format($product->price) }}</td>

                    <td>
                        <span class="{{ $product->stock < 5 ? 'text-danger' : '' }}">
                            {{ $product->stock }}
                        </span>
                    </td>

                    <!-- UNGGULAN -->
                    <td>
                        @if($product->unggulan)
                            <span class="badge bg-success">Ya</span>
                        @else
                            <span class="badge bg-secondary">Tidak</span>
                        @endif
                    </td>

                    <!-- AKSI -->
                    <td>
                        <a href="{{ route('produk.edit', $product->id) }}" 
                           class="btn btn-sm btn-primary">
                           Edit
                        </a>

                        <form action="{{ route('produk.destroy', $product->id) }}" 
                              method="POST" 
                              style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" 
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin hapus produk ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="7" class="text-center">Data produk belum ada</td>
                </tr>
                @endforelse
            </tbody>

        </table>

    </div>

</div>

@endsection
@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto mt-6 px-4">

    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Edit Produk</h2>

    <div class="bg-white rounded-2xl shadow-sm border p-6">

        <form action="{{ route('produk.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-600 mb-1">Nama Produk</label>
                <input type="text" name="name" value="{{ $product->name }}"
                    class="w-full rounded-xl border border-gray-200 px-4 py-3 bg-gray-50 focus:ring-2 focus:ring-slate-800 focus:outline-none">
            </div>

            <div class="grid md:grid-cols-2 gap-5 mb-5">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Harga</label>
                    <input type="number" name="price" value="{{ $product->price }}"
                        class="w-full rounded-xl border border-gray-200 px-4 py-3 bg-gray-50 focus:ring-2 focus:ring-slate-800">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Stok</label>
                    <input type="number" name="stock" value="{{ $product->stock ?? '' }}"
                        class="w-full rounded-xl border border-gray-200 px-4 py-3 bg-gray-50 focus:ring-2 focus:ring-slate-800">
                </div>
            </div>

            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-600 mb-1">Deskripsi</label>
                <textarea name="description" rows="5"
                    class="w-full rounded-xl border border-gray-200 px-4 py-3 bg-gray-50 focus:ring-2 focus:ring-slate-800">{{ $product->description }}</textarea>
            </div>

            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-600 mb-1">Kode Gambar Unsplash</label>
                <input type="text" name="image" value="{{ $product->image ?? '' }}"
                    class="w-full rounded-xl border border-gray-200 px-4 py-3 bg-gray-50 focus:ring-2 focus:ring-slate-800">
            </div>

            <div class="flex items-center gap-2 mb-6">
                <input type="checkbox" name="is_featured" value="1"
                    class="w-4 h-4"
                    {{ !empty($product->is_featured) ? 'checked' : '' }}>
                <label class="text-sm text-gray-700">Jadikan Produk Unggulan</label>
            </div>

            <div class="flex flex-col md:flex-row gap-4">
                <button type="submit"
                    class="bg-slate-900 text-white px-6 py-3 rounded-xl w-full md:w-auto hover:bg-black transition">
                    Update Produk
                </button>

                <a href="{{ route('products.index') }}"
                    class="bg-gray-200 text-gray-700 px-6 py-3 rounded-xl text-center w-full md:w-auto hover:bg-gray-300">
                    Batal
                </a>
            </div>

        </form>

    </div>

</div>

@endsection
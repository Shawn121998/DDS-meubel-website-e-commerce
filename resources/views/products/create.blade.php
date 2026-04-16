@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-6 px-4">

    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Tambah Produk</h2>

    <div class="bg-white rounded-2xl shadow-sm border p-6">

        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nama Produk -->
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-600 mb-1">Nama Produk</label>
                <input type="text" name="name"
                    class="w-full rounded-xl border border-gray-200 px-4 py-3 bg-gray-50 focus:ring-2 focus:ring-slate-800 focus:outline-none"
                    required>
            </div>

            <!-- Harga -->
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-600 mb-1">Harga</label>
                <input type="number" name="price"
                    class="w-full rounded-xl border border-gray-200 px-4 py-3 bg-gray-50 focus:ring-2 focus:ring-slate-800 focus:outline-none"
                    required>
            </div>

            <!-- Deskripsi -->
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-600 mb-1">Deskripsi</label>
                <textarea name="description"
                    class="w-full rounded-xl border border-gray-200 px-4 py-3 bg-gray-50 focus:ring-2 focus:ring-slate-800 focus:outline-none"></textarea>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-slate-800 text-white px-6 py-2 rounded-xl hover:bg-slate-900">
                    Simpan Produk
                </button>
            </div>

        </form>

    </div>
</div>
@endsection
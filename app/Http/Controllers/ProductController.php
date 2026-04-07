<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // ===============================
    // HALAMAN KATALOG
    // ===============================
    public function index()
    {
        $products = Product::latest()->paginate(8);
        return view('products.index', compact('products'));
    }

    // ===============================
    // HALAMAN FORM TAMBAH PRODUK
    // ===============================
    public function create()
    {
        return view('products.create');
    }

    // ===============================
    // SIMPAN PRODUK BARU
    // ===============================
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    // ===============================
    // HALAMAN DETAIL
    // ===============================
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    // ===============================
    // HALAMAN EDIT PRODUK
    // ===============================
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // ===============================
    // UPDATE PRODUK
    // ===============================
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diupdate');
    }

    // ===============================
    // HAPUS PRODUK
    // ===============================
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus');
    }
}
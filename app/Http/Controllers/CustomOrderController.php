<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CustomOrder;
use Illuminate\Http\Request;

class CustomOrderController extends Controller
{
    public function index()
    {
        return view('custom-order');
    }

    public function store(Request $request)
    {
        // VALIDASI (tidak bikin crash)
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'material' => 'required',
            'size_panjang' => 'required',
            'size_lebar' => 'required',
            'size_tinggi' => 'required',
        ]);

        // AMBIL DATA DENGAN AMAN
        $name = $request->input('name');
        $description = $request->input('description');
        $material = $request->input('material');

        $panjang = $request->input('size_panjang');
        $lebar   = $request->input('size_lebar');
        $tinggi  = $request->input('size_tinggi');

        // GABUNG SIZE
        $size = $panjang . ' x ' . $lebar . ' x ' . $tinggi;

        // SIMPAN KE DATABASE
        CustomOrder::create([
            'user_id' => auth()->id() ?? 1, // 🔥 biar tidak error kalau belum login
            'name' => $name,
            'description' => $description,
            'material' => $material,
            'size' => $size,
        ]);

        return redirect()->back()->with('success', 'Pesanan custom berhasil dikirim!');
    }
}
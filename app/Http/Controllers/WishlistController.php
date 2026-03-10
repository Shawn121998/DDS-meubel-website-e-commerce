<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{

    public function index()
    {
        $wishlists = Wishlist::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return view('wishlist.index', compact('wishlists'));
    }


    public function add($id)
    {
        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $id
        ]);

        return redirect()->back()->with('success', 'Produk ditambahkan ke wishlist');
    }

}
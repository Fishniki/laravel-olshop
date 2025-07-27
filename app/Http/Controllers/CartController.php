<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('pakaian')->where('user_id', Auth::user()->id)->get();
        return view('user.cart', compact('carts'));
    }

    public function cartsave(Request $request)
    {
        $existingCart = Cart::where('pakaian_id', $request->pakaian_id)
                            ->where('user_id', Auth::user()->id)
                            ->first();
        if ($existingCart) {
            return redirect()->route('user-dashboard')->with('Error', 'Pakaian sudah ada di keranjang');
        }

        $cart = new Cart();
        $cart->pakaian_id = $request->pakaian_id;
        $cart->user_id = Auth::user()->id;
        $cart->save();
        
        return redirect()->route('user-dashboard')->with('Success', 'Berhasil dimasukan ke keranjang');
    }

    public function carddelete($id)
    {
        $pakaian = cart::findOrFail($id);
        $pakaian->delete();

        if ($pakaian) {
            return redirect()->route('cart')->with('Success', "Data $id berhasil di hapus");
        } else {
            return redirect()->route('cart')->with('Error', 'Data gagal di hapus');
        }
    }
}

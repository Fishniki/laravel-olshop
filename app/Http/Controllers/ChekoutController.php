<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Pakaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChekoutController extends Controller
{

    public function index()
    {
        if (!session()->has('selectedItems') || empty(session('selectedItems'))) {
            return redirect()->route('cart')->with('message', 'Tidak ada item dalam keranjang.');
            
        }
        
        $alamat = Alamat::where('user_id', Auth::user()->id)->get();
        return view('user.chekout', compact('alamat'));
    }

    public function processCheckout(Request $request)
    {
        $chekedIds = $request->input('cheked_id', []);
        $quantities = $request->input('quantities', []);

        $selectedItems = Pakaian::whereIn('id', $chekedIds)->get()->map(function ($item) use ($quantities) {
            $jumlah = $quantities[$item->id] ?? 1; // Ambil jumlah atau default ke 1
            return [
                'id' => $item->id,
                'nama' => $item->nama,
                'harga' => $item->harga,
                'image' => $item->image,
                'jumlah' => $jumlah, // Default jumlah 1 jika tidak ditemukan
                'subtotal' => $item->harga * $jumlah // Total harga per item
            ];
        });
        $totalsemuaItem = $selectedItems->sum('subtotal');

        session([
            'selectedItems' => $selectedItems,
            'totalsemuaItem' => $totalsemuaItem

        ]);
        session()->save();

        return redirect()->route('chekout');
    }

    public function cancelchekout()
    {
        session()->forget(['selectedItems', 'totalsemuaItem']);
        return redirect()->route('cart')->with('message', 'Checkout dibatalkan.');
    }

    
    //midtrans payment
    // public function chekoutPayment(Request $request)
    // {
    //     dd($request)->all();
    // }
}

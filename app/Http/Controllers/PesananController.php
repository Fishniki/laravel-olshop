<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Pakaian;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function unpaid() {
        $pesanans = Order::where('user_id', Auth::user()->id)->where('status', 'Unpaid')->get();
        $pesanans->map(function ($pesanan) {
           $pakaianIds = json_decode($pesanan->pakaian_id, true);
           $pesanan->pakaian = Pakaian::whereIn('id', $pakaianIds)->get();
           
        return $pesanan;
        });

        // if ($pesanans->isEmpty()) {
        //     return redirect()->route('pesanan.paid')->with('sucsess', 'Anda sudah melakukan pembayaran');
        // }

        return view('user.pesanan.belum-bayar', compact('pesanans'));
    }

    public function paid()
    {
        $paid = Order::where('user_id', Auth::user()->id)->whereIn('status', ['Paid', 'Shipped'])->get();
        $paid->map(function ($dikemas) {
            $pakaianIds = json_decode($dikemas->pakaian_id, true);
            $dikemas->pakaians = Pakaian::whereIn('id', $pakaianIds)->get();
        });
        return view('user.pesanan.dikemas', compact('paid'));
    }

    public function delivered()
    {
        $delivered = Order::where('user_id', Auth::user()->id)->where('status', 'Delivered')->get();
        $delivered->map(function ($pesanan) {
            $pakaianIds = json_decode($pesanan->pakaian_id, true);
            $pesanan->pakaian = Pakaian::whereIn('id', $pakaianIds)->get();
        });
        return view('user.pesanan.dikirim', compact('delivered'));
    }

    public function finished()
    {
        $finished = Order::where('user_id', Auth::id())->where('status', 'Finished')->get();

        
        $finished->map(function ($pesanan) {
            $pakaianIds = json_decode($pesanan->pakaian_id, true);
            $pesanan->pakaians = Pakaian::whereIn('id', $pakaianIds)->get();
        });

        return view('user.pesanan.finish', compact('finished'));
    }

    public function penilaian()
    {
        $penilaian = Rating::with(['pakaian', 'user']) // eager load relasi
        ->where('user_id', Auth::id())
        ->get();
        return view('user.pesanan.penilaian', compact('penilaian'));
    }
}

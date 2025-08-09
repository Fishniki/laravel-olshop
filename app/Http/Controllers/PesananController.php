<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Pakaian;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function unpaid()
    {
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
        $finished = Order::where('user_id', Auth::id())
            ->where('status', 'Finished')
            ->get();

        $finished->map(function ($pesanan) {
            $pakaianIds = json_decode($pesanan->pakaian_id, true);

            // Ambil ID pakaian yang sudah dirating oleh user ini untuk order ini
            $ratedProductIds = Rating::where('user_id', Auth::id())
                ->where('order_id', $pesanan->order_id) // UUID
                ->pluck('product_id')
                ->toArray();

            // Filter pakaian yang belum diberi rating
            $pakaianBelumRated = array_diff($pakaianIds, $ratedProductIds);

            $pesanan->pakaians = Pakaian::whereIn('id', $pakaianBelumRated)->get();
        });

        // Hanya tampilkan pesanan yang masih ada pakaian belum rated
        $finished = $finished->filter(function ($pesanan) {
            return $pesanan->pakaians->isNotEmpty();
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

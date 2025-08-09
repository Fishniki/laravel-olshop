<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Pakaian;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TableProduk extends Controller
{
    public function index()
    {
        $products = Pakaian::orderBy('id', 'desc')->get();
        $total = Pakaian::count();
        return view('admin.table-produk', compact('products', 'total'));
    }

    public function show($id)
    {
        $product = Pakaian::findOrFail($id);

        // Ambil semua order finished
        $orders = Order::where('status', 'Finished')->get();

        $total_terjual = 0;

        foreach ($orders as $order) {
            $pakaianIds = json_decode($order->pakaian_id, true);
            $jumlahOrders = json_decode($order->jumlah_order, true);

            if (!$pakaianIds || !$jumlahOrders) {
                continue; // skip kalau data rusak/null
            }

            foreach ($pakaianIds as $index => $pid) {
                if ((string) $pid === (string) $product->id) {
                    $total_terjual += (int) $jumlahOrders[$index];
                }
            }
        }

        $stock_produk = $product->stok - $total_terjual;

        $ratings = Rating::where('product_id', $id)
            ->whereNull('parent_id')
            ->with(['user', 'replies.user'])
            ->latest()
            ->get();
        
            // dd($ratings);

        return view('admin.detail-produk', compact('product', 'total_terjual', 'ratings', 'stock_produk'));
    }



    public function reply(Request $request, $ratingId)
    {
        $request->validate([
            'comment' => 'required|string'
        ]);

        Rating::create([
            'rating'     => null, // balasan tidak perlu nilai rating
            'comment'    => $request->comment,
            'image'      => null,
            'order_id'   => null, // balasan tidak terkait order langsung
            'user_id'    => Auth::id(),
            'product_id' => null,
            'parent_id'  => $ratingId,
        ]);

        return back()->with('success', 'Balasan berhasil dikirim');
    }
}

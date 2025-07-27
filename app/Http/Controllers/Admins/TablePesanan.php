<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Pakaian;
use Illuminate\Http\Request;

class TablePesanan extends Controller
{
    public function index()
    {
        $orderans = Order::orderBy('id', 'desc')->get();
        $orderans->map(function($orderan) {
            $orderanIds = json_decode($orderan->pakaian_id, true);
            $orderan->pakaian = Pakaian::whereIn('id', $orderanIds)->get();
        });
        // dd($orderans);
        return view('admin.table-pesanan', compact('orderans'));
    }

    public function detailpesanan($id)
    {
        $order = Order::with(['user', 'alamat'])->findOrFail($id);

    // Decode JSON ke array
    $order->jumlah_order = json_decode($order->jumlah_order, true);
    $order->harga_peritem = json_decode($order->harga_peritem, true);
    $order->pakaian_id = json_decode($order->pakaian_id, true);

    // Ambil data pakaian berdasarkan ID yang sudah didecode
    $order->pakaian = Pakaian::whereIn('id', $order->pakaian_id)->get();
        return view('admin.order.detail-pesanan', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->touch();
        $order->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
}

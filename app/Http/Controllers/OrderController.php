<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function chekoutPayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pakaian_id' => 'required|array',
            'jumlah_order' => 'required|array',
            'harga_peritem' => 'required|array', // Pastikan ada harga
            'total_order' => 'required|numeric', // Harus integer, bukan array
            'alamat_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $order =  Order::create([
            'pakaian_id' => json_encode($request->pakaian_id),
            'jumlah_order' => json_encode($request->jumlah_order),
            'harga_peritem' => json_encode($request->harga_peritem),
            'total_order' => (int) $request->total_order, // Pastikan integer
            'alamat_id' => (int) $request->alamat_id,
            'user_id' => Auth::user()->id,
        ]);


        // menghapus data pada table yang telah di chekout
        DB::table('carts')
            ->where('user_id', Auth::id())
            ->whereIn('pakaian_id', $request->pakaian_id)
            ->delete();

        // menghapus session pada halaman chekout
        // agar user tidak dapat mengakses /chekout
        session()->forget(['selectedItems', 'totalsemuaItem']);


        // setup snap pembayaran
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-CbAFDRthuCA-scOItmjvFm39';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $order->order_id,
                'gross_amount' => $order->total_order,
            ),
            'customer_details' => array(
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => $order->alamat->no_hp,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        // dd([$params, $snapToken]);
        session(['snap_token' => $snapToken]);
        session()->save();


        return redirect()->route('pesanan')->with('success', 'Pesanan berhasil dibuat!');
    }


    public function callback(Request $request)
    {
        $serverKey = config('setup-midtrans.server_key');
        $hashed = hash("SHA512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed !== $request->signature_key) {
            Log::error('Invalid signature key');
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        $order = Order::where('order_id', $request->order_id)->first();

        if (!$order) {
            Log::error('Order tidak ditemukan: ' . $request->order_id);
            return response()->json(['error' => 'Order not found'], 404);
        }

        if (in_array($request->transaction_status, ['settlement', 'capture'])) {
            $order->update(['status' => 'Paid']);
            Log::info("Order {$order->order_id} status updated to Paid");
        }

        return response()->json(['message' => 'Callback processed']);
    }



    public function paymentFinished()
    {
        return view('user.finish-payment');
    }
}

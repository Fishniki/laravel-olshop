<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RatingsController extends Controller
{
    public function ratings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pakaian_id' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->route('pesanan.finished')
                ->withInput()
                ->withErrors($validator);
        }


        if ($request->hasFile('image')) {
            $item_image = $request->file('image')->store('ratings-image', 'public');
        } else {
            return redirect()->route('pesanan.finished')->withErrors(['image' => 'File tidak ditemukan']);
        }


        $order = Order::where('user_id', Auth::id())->get();
        
        

        $ratings = new Rating();
        $ratings->user_id = Auth::id();
        $ratings->rating = $request->rating;
        $ratings->product_id = $request->pakaian_id;
        $ratings->comment = $request->ulasan;
        $ratings->image = $item_image;
        $ratings->order_id =  $order->order_id;
        $ratings->save();

        return redirect()->route('pesanan.finished')->with('Success', 'Rating Berhasil Ditambahkan');
    }

    // public function tambahRate(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'rating' => 'required|integer',
    //     ]);

    //     if ($validator->passes()){
    //         return redirect()->route('')
    //     }
    // }
}

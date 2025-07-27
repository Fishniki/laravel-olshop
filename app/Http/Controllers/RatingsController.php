<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RatingsController extends Controller
{
    public function ratings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pakaian_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'required|string|max:255'
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

        $ratings = new Rating();
        $ratings->rating = $request->rating;
        $ratings->product_id = $request->pakaian_id;
        $ratings->comment = $request->ulasan;
        $ratings->image = $item_image;
        $ratings->save();

        return redirect()->route('pesanan.finished')->with('Success', 'Rating Berhasil Ditambahkan');
    }
}

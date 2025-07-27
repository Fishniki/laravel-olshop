<?php

namespace App\Http\Controllers;

use App\Models\Pakaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PakaianController extends Controller
{
    public function create()
    {
        return view('admin.form-pakaian');
    }

    public function edit($id)
    {
        $product = Pakaian::findOrFail($id);
        return view('admin.update-pakaian', compact('product'));
    }

    public function save(Request $request)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'nama' => 'required',
        'harga' => 'required|integer',
        'stok' => 'required|integer',
        'kategori' => 'required|string',
        'bobot' => 'required|string',
        'sent_from' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'deskripsi' => 'required|string'
    ]);

    // Jika validasi gagal, kembalikan error
    if ($validator->fails()) {
        return redirect()->route('create-pakaian')
            ->withInput()
            ->withErrors($validator);
    }

    // Proses upload file jika ada
    if ($request->hasFile('image')) {
        $item_image = $request->file('image')->store('items-image', 'public');
    } else {
        return redirect()->route('create-pakaian')->withErrors(['image' => 'File tidak ditemukan']);
    }

    // Simpan data ke database
    $pakaian = new Pakaian();
    $pakaian->nama = $request->nama;
    $pakaian->harga = $request->harga;
    $pakaian->stok = $request->stok;
    $pakaian->kategori = $request->kategori;
    $pakaian->bobot = $request->bobot;
    $pakaian->sent_from = $request->sent_from;
    $pakaian->deskripsi = $request->deskripsi;
    $pakaian->author = Auth::guard('admin')->user()->name;
    $pakaian->image = $item_image; // Path untuk ditampilkan di front-end
    $pakaian->save();

    return redirect()->route('table-produk')->with('success', 'Pakaian Berhasil Ditambahkan');
}



    public function savechanges(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
            'kategori' => 'string',
            'author' => 'string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->passes()) {
            $pakaian = Pakaian::findOrFail($id);

            if ($request->hasFile('image')) {
                if ($pakaian->image && Storage::disk('public')->exists($pakaian->image)) {
                    Storage::disk('public')->delete($pakaian->image);
                }
                $item_image = $request->file('image')->store('items-image', 'public');
                $pakaian->image = $item_image;
            }

            $pakaian->nama = $request->nama;
            $pakaian->harga = $request->harga;
            $pakaian->stok = $request->stok;
            $pakaian->kategori = $request->kategori;
            $pakaian->author = Auth::guard('admin')->user()->name;
            $pakaian->save();

            return redirect()->route('table-produk')->with('Success', 'Pakaian Berhasil Ditambahkan');
        }else{
            return redirect()->route('edit-pakaian', ['id'=>$id])
            ->withInput()
            ->withErrors($validator);
        }
    }

    public function delete($id)
    {
        $pakaian = Pakaian::findOrFail($id);
        Storage::disk('public')->delete($pakaian->image);
        $pakaian->delete();

        if ($pakaian) {
            return redirect()->route('table-produk')->with('Success', "Data $id berhasil di hapus");
        } else {
            return redirect()->route('table-produk')->with('Error', 'Data gagal di hapus');
        }
    }   
}

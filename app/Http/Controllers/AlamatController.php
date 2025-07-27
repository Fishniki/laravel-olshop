<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AlamatController extends Controller
{
    public function index()
    {
        return view('user.form-alamat');
    }

    public function procesalamat(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nama" => "required",
            "no_hp" => "required|string",
            "provinsi" => "required|string",
            "kabkot" => "required|string",
            "kecamatan" => "required|string",
            "kelurahan" => "required|string",
            "alamat" => "required|string",
            "jenis_alamat" => "required|string",
        ]);

        if ($validator->passes()) {
            
            $alamat = new Alamat();
            $alamat->nama = $request->nama;
            $alamat->no_hp = $request->no_hp;
            $alamat->provinsi = $request->provinsi;
            $alamat->kabkot = $request->kabkot;
            $alamat->kecamatan = $request->kecamatan;
            $alamat->kelurahan = $request->kelurahan;
            $alamat->alamat = $request->alamat;
            $alamat->jenis_alamat = $request->jenis_alamat;
            $alamat->user_id = Auth::user()->id;
            $alamat->save();

            return redirect()->route('chekout')->with('Success', 'Alamat Berhasil Ditambahkan');
        }else{
            return redirect()->route('alamat')
            ->withInput()
            ->withErrors($validator);
        }
    }

    public function editalamat($id)
    {
        $alamat = Alamat::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
        return view('user.edit-alamat', compact('alamat'));
    }

    public function editAlamatSave(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "nama" => "required",
            "no_hp" => "required|string",
            "provinsi" => "required|string",
            "kabkot" => "required|string",
            "kecamatan" => "required|string",
            "kelurahan" => "required|string",
            "alamat" => "required|string",
            "jenis_alamat" => "required|string",
        ]);

        if ($validator->passes())
        {
            $alamat = Alamat::findOrFail($id);
            $alamat->nama = $request->nama;
            $alamat->no_hp = $request->no_hp;
            $alamat->provinsi = $request->provinsi;
            $alamat->kabkot = $request->kabkot;
            $alamat->kecamatan = $request->kecamatan;
            $alamat->kelurahan = $request->kelurahan;
            $alamat->alamat = $request->alamat;
            $alamat->jenis_alamat = $request->jenis_alamat;
            $alamat->user_id = Auth::user()->id;
            $alamat->save();

            return redirect()->route('chekout')->with('Success', 'Alamat Berhasil Ditambahkan');
        }

        return redirect()->route('edit.alamat'. ['id' => $id])
        ->withInput()
        ->withErrors($validator);
    }

    public function deleteAlamat($id)
    {
        $pakaian = Alamat::findOrFail($id);
        $pakaian->delete();

        if ($pakaian) {
            return redirect()->route('chekout')->with('Success', "Data $id berhasil di hapus");
        }
    }
}
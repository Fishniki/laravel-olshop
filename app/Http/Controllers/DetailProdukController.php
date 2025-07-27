<?php

namespace App\Http\Controllers;

use App\Models\Pakaian;
use Illuminate\Http\Request;

class DetailProdukController extends Controller
{
    public function index($id)
    {   
        $pakaian = Pakaian::findOrFail($id);
        return view('user.detail-produk', compact('pakaian'));
    }
}

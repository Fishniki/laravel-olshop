<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Pakaian;
use Illuminate\Http\Request;

class TableProduk extends Controller
{
    public function index()
    {
        $products = Pakaian::orderBy('id', 'desc')->get();
        $total = Pakaian::count();
        return view('admin.table-produk', compact('products', 'total'));
    }
}

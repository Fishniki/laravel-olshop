<?php

namespace App\Http\Controllers;

use App\Models\Pakaian;
use Illuminate\Http\Request;

class DashboardUserController extends Controller
{
    public function index()
    {
        $pakaian = Pakaian::orderBy('id', 'desc')->get();
        return view('user.dashboard', compact('pakaian'));
    }
}

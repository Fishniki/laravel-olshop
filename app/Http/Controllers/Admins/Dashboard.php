<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Pakaian;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index() 
    {
        return view('admin.dashboard');
    }
}

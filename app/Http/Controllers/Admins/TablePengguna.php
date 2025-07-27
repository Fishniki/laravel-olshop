<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class TablePengguna extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.table-pengguna', compact('users'));
    }
}

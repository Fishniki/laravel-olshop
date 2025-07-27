<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Login extends Controller
{
    public function index()
    {
        return view('admin.auth.form-login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if ($validator->passes()) {
              if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                  if (Auth::guard('admin')->user()->role != 'admin') {
                    Auth::guard('admin')->logout();
                    return redirect()->route('login-admin')->with('Error', 'Kamu tidak punya akses ke halaman ini');
                  }
                  return redirect()->route('admin-dashboard');
              }else{
                return redirect()->route('login-admin')->with('Error', 'Other email or Password in correct');
              }
        }else{
            return redirect()->route('login-admin')
            ->withInput()
            ->withErrors($validator);
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login-admin');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginUserController extends Controller
{
    public function index()
    {
        return view('user.auth.form-login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->passes()){
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('user-dashboard');
            }else{
                return redirect()->route('login')->with('Error', 'Other email or Password in correct');
            }
        }else{
            return redirect()->route('login')
            ->withInput()
            ->withErrors($validator);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

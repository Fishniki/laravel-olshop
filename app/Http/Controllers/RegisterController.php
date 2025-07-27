<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index()
    {
        return view('form-register');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required'
        ]);

        if ($validator->fails()) {
        return redirect()->route('create-pakaian')
            ->withInput()
            ->withErrors($validator);
        }

        if ($request->hasFile('profile')) {
        $item_image = $request->file('profile')->store('profile-image', 'public');
        } else {
            return redirect()->route('register')->withErrors(['image' => 'File tidak ditemukan']);
        }

        
        if ($validator->passes()){
            
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->image = $item_image;
            $user->password = Hash::make($request->password);
            $user->save();

            event(new Registered($user)); 
            return redirect()->route('login')->with('Success', 'Register Berhasil');

        }else{
            return redirect()->route('register')
            ->withInput()
            ->withErrors($validator);
        }


    }
}

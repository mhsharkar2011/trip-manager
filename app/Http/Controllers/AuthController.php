<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

// ============================== Login Section Start ==============================
public function login(Request $request)
{
    if(Auth::check() && $request->user()->hasRole('admin')){
        return redirect()->route('dashboard');
    }else{
        return view('auth.login');
    }
}

public function storeLogin(Request $request)
{
    $validator =  Validator::make($request->all(),[
        'email' => 'required', 
        'password' => 'required'
    ]);

    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $credentails = $request->only('email', 'password');

    if(Auth::attempt($credentails)){
       return redirect()->route('dashboard');
    }else{
        return redirect()->route('admin.login');
    }
}
// ============================== Login Section End ==============================

    public function register()
    {
        $data['title'] = "Register Page";
        return view('auth.register',$data);
    }

    public function storeRegister(Request $request)
    {
        $validator =  Validator::make($request->all(),[
            'first_name' => 'required',
            'email' => 'required|unique:users',
            'password' =>'required|confirmed'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $patient = User::create([
            'first_name' => $request->input('first_name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        Auth::login($patient);
        $credentails = $request->only('email', 'password');

        if(Auth::attempt($credentails)){
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('admin.login');
        }
    }

// ============================== Logout Section ==============================
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}

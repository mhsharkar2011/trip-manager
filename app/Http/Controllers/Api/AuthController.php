<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function registration(Request $request)
    {
        return $this->respond(\App\Models\User::create(['name'=>\request('name'),'email'=>\request('email'),'password'=>Hash::make(\request('password'))]));
    }

    public function login()
    {
        $user = \App\Models\User::where(['email'=>\request('email')])->first();
        if($user && Hash::check(\request('password'),$user->password)){
            return $user->createToken('api_token');
        }
    }


}

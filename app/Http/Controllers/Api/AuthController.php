<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

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
            return $user->createToken('api_token')->plainTextToken;
        }
    }

    public function forgotPassword()
    {
        $credentials = request()->validate(['email' => 'required|email']);

        Password::sendResetLink($credentials);

        return $this->respond('Mail sent');
    }

    public function resetPassword()
    {
        $credentials = request()->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string'
        ]);

        $reset_password_status = Password::reset($credentials, function ($user, $password) {
            $user->password = bcrypt($password);
            $user->save();
        });

        if ($reset_password_status == Password::INVALID_TOKEN) {
            return response()->json(["msg" => "Invalid token provided"], 400);
        }

        return response()->json(["msg" => "Password has been successfully changed"]);
    }


}

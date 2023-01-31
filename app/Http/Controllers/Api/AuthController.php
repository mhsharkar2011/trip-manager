<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{

    public function store(Request $request)
    {
        request()->merge([
            'password' => bcrypt($request->get('password'))
        ]);

        $user = User::create($request->all());

        if (app()->environment() !== 'production') {
            $user->email_verified_at = now();
            $user->save();
        }

        return $this->respond($user);
    }

    public function login()
    {
        $user = User::where([
            'email'=> request('email')
        ])->firstOrFail();

        if($user && $user->email_verified_at === NULL) {
            return $this->respondForbidden('Your account is not active! Please verify your email address.');
        }

        if($user && Hash::check(\request('password'),$user->password)) {
            $token = $user->createToken('api_token')->plainTextToken;

            $response['companies'] = [
                [
                    "company_code"=> null,
                    "company_name" => "ITC",
                ]
            ];
            $response['roles'] = [];
            $response['session'] = [
                'access_token' => $token
                ,'session_last_access' => 0
                ,'session_start' => 0
            ];
            $response['user_info'] = $user;

            return $this->respond($response);
        }

        return $this->respondNotFound('Incorrect email or password.');
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

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(["msg" => "User logged out"], 200);
    }

}

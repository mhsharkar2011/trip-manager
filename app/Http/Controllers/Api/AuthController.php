<?php

namespace App\Http\Controllers\Api;

use App\Devpanel\Models\Tenant;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    const LOGIN_API_TOKEN = 'login_api_token';

    public function store(Request $request)
    {
        request()->merge([
            'password' => bcrypt($request->get('password'))
        ]);

        $user = User::create($request->all());

        //tmp: we don't have verification email yet
        //so untill then verifying email by default
        $user->email_verified_at = now();
        $user->save();

        return $this->respond($user);
    }

    public function login()
    {
        $user = User::with('roles.permissions')->where([
            'email'=> request('email')
        ])->firstOrFail();

        if($user && $user->email_verified_at === NULL) {
            return $this->respondForbidden('Your account is not active! Please verify your email address.');
        }

        if($user && Hash::check(\request('password'),$user->password)) {
            $token = $user->createToken(self::LOGIN_API_TOKEN)->plainTextToken;

            //tmp: for now returning all companies to test Multi-tenancy
            //later we will return only companies that user belong to
            $companies = Tenant::all()->map(function($t) {
                return  [
                    "id" => $t->id,
                    "company_name" => $t->name,
                ];
            });
            $response['companies'] = $companies;
            $response['roles'] = $user->roles;
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

<<<<<<< HEAD
    public function logout(Request $request)
    {
        $request->user()->tokens()->where('name', self::LOGIN_API_TOKEN)->delete();

        return response()->json(["msg" => "User logged out"], 200);
    }
=======
    //impersonation: for admin to login as any user
    public function getATokenForAutoLogin($user_id)
    {
        if (auth('sanctum')->user()->isAdmin()) {
            $user = User::findOrFail($user_id);

            return $this->respond([
                'data' => [
                    'token' => $user->createToken('auto_login')->plainTextToken
                ]
            ]);
        }

        return $this->respondForbidden();
    }

    public function auto_login()
    {
        $validation = Validator::make(request()->all(),
            [
                'token' => 'required',
            ]
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }

        $user = optional(\Laravel\Sanctum\PersonalAccessToken::findToken(request('token')))->tokenable;

        if (! $user) {
            return $this->respondBadRequest('Could not find user from token');
        }

        $token = $user->createToken('auto_login')->plainTextToken;

        //tmp: for now returning all companies to test Multi-tenancy
        //later we will return only companies that user belong to
        $companies = Tenant::all()->map(function($t) {
            return  [
                "id" => $t->id,
                "company_name" => $t->name,
            ];
        });

        $response['companies'] = $companies;
        $response['roles'] = [];
        $response['session'] = [
            'access_token' => $token
            ,'session_last_access' => 0
            ,'session_start' => 0
        ];
        $response['user_info'] = $user;

        return $this->respond($response);
    }
>>>>>>> develop

}

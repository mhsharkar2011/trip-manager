<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SocialLogin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\DB;

class SocialLoginController extends Controller
{
    public function redirect($provider)
    {
        $params_for_state = [
            "frontend_redirect_url" => request('frontend_redirect_url')
        ];
        $state = Crypt::encrypt($params_for_state);

        $socialite = Socialite::driver($provider);

        if(request('scopes')){
            $socialite->scopes(request('scopes'));
        }

        if(request('reset_scopes_to')){
            $socialite->setScopes(request('reset_scopes_to'));
        }

        return  $socialite->stateLess()->with(['state' => $state])->redirect();
    }


    public function callback($provider)
    {
        $user_info = Socialite::driver($provider)->stateLess()->user();
        
        $user = DB::transaction(function () use($user_info, $provider) {
            $user = User::firstOrCreate(
                [
                    'email' => $user_info->getEmail()
                ],
                [
                    'name' =>$user_info->getName(),
                    'email' => $user_info->getEmail(),
                ]
            );

            SocialLogin::firstOrCreate(
                [
                    'provider_id' => $user_info->getId()
                ],
                [
                    'user_id' => $user->id,
                    'provider' => $provider,
                    'provider_id' => $user_info->getId(),
                    'user_details' => $user_info,
                    'nickname' => $user_info->getNickname(),
                    'name' => $user_info->getName(),
                    'avatar' => $user_info->getAvatar(),
                    'token' => $user_info->token,
                    'refreshToken' => $user_info->refreshToken,
                    'expire' => $user_info->expiresIn,
                ]
            );
                
            return $user;
        });

        $state_params = Crypt::decrypt(request('state'));
        
        if ($state_params['frontend_redirect_url']) {
            $user['access_token'] = $user->createToken('social_login')->plainTextToken;

            $frontend_redirect_url = sprintf("%s?success=true&token=%s", $state_params['frontend_redirect_url'], $user['access_token']);
            return redirect()->to($frontend_redirect_url);
        } else {
            auth()->loginUsingId($user->id);
            return redirect()->intended();
        }
    
    }
}

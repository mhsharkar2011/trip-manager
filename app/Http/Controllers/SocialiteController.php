<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;


class SocialiteController extends Controller
{
    public function authRedirect($provider)
    {
        return Socialite::driver($provider)->setScopes(['read_content', 'write_content'])->redirect();
    }


    public function authCallback($provider)
    {
        $user_info = Socialite::driver($provider)->stateless()->user();
        // dd($user_info);
        $user = \App\Models\User::firstOrCreate(
            ['email' => $user_info->getEmail()],

            [
                'name' =>$user_info->getName(),
                'email' => $user_info->getEmail(),
            ]);

        if($user){
            $socialite_login = \App\Models\SocialiteLogin::firstOrCreate(
                ['provider_id' => $user_info->getId()],
                [
                    'user_id' => $user->id,
                    'provider_id' => $user_info->getId(),
                    'user_details' => $user_info,
                    'provider' => $provider,
                    'nickname' => $user_info->getNickname(),
                    'name' => $user_info->getName(),
                    'avatar' => $user_info->getAvatar(),
                    'token' => $user_info->token,
                    'refreshToken' => $user_info->refreshToken,
                    'expire' => $user_info->expiresIn,
                ]);
                
            auth()->loginUsingId($user->id);
            return redirect()->intended();
        }    
    }
}

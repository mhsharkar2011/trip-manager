<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\DB;

class SocialiteController extends Controller
{
    public function authRedirect($provider)
    {
        $data = [
            "fe_url" => request('fe_url')
          ];

        $encrypt_data = Crypt::encrypt($data);

        $socialite = Socialite::driver($provider);

        if(request('scopes')){
            $socialite->setScopes(request('scopes'));
        }

        return  $socialite->with(['state' => $encrypt_data])->redirect();
    }


    public function authCallback($provider)
    {
        $user_info = Socialite::driver($provider)->stateLess()->user();
        
        $user =  DB::transaction(function () use($user_info, $provider){

            $new_user = \App\Models\User::firstOrCreate(
                ['email' => $user_info->getEmail()],
    
                [
                    'name' =>$user_info->getName(),
                    'email' => $user_info->getEmail(),
            ]);

            \App\Models\SocialiteLogin::firstOrCreate(
                ['provider_id' => $user_info->getId()],
                [
                    'user_id' => $new_user->id,
                    'provider_id' => $user_info->getId(),
                    'user_details' => $user_info,
                    'provider' => $provider,
                    'nickname' => $user_info->getNickname(),
                    'name' => $user_info->getName(),
                    'avatar' => $user_info->getAvatar(),
                    'token' => $user_info->token,
                    'refreshToken' => $user_info->refreshToken,
                    'expire' => $user_info->expiresIn,
                ]
                );
                return $new_user;
        });

        $decrypt_data = Crypt::decrypt(request('state'));
        
        if ($decrypt_data['fe_url']) {
            //create a token through sanctum
            $user['access_token'] = $user->createToken('social_login')->plainTextToken;
            //and send the token and user details in json
            return redirect()->to(config('app.fe_url').'/'.$decrypt_data['fe_url'].'?success=true&token='.$user['access_token']);
        } else {
            auth()->loginUsingId($user->id);
            return redirect()->intended();
        }
    
    }
}

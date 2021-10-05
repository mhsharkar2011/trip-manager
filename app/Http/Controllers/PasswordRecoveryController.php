<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\PasswordRecover;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PasswordRecoveryController extends Controller
{
    public function passwordRecovery()
    {
        $email = request('email');
        $code = request('rcovery_code');

        $user = User::whereEmail($email)->first();

        if($user){

            if($code){
                if(User::whereRcoveryCode($code)->exists()) return $this->respond($user);

                return $this->respondError('Verification Code Invalid');
            }else{
                $auto_code = rand(9999,99999);
                $user->rcovery_code = $auto_code; $user->save();

                $details = [
                    'title' => 'Your Password recovery verification code bellow this.',
                    'code' => $auto_code
                ];
          
                Mail::to($user->email)->send(new PasswordRecover($details));
                return $this->respond('Verification code send to you email.');
            }
        }
        return $this->respondError('User Not Found');
    }

    public function changePassword(User $user)
    {
        $user->password = request('password'); $user->save();
        return $this->respond($user);
    }
}

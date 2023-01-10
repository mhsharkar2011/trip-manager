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
        $code = request('recovery_code');

        $user = User::whereEmail($email)->first();

        if($user){

            if($code){
                if(User::whererecoveryCode($code)->exists()) return $this->respond($user);

                return $this->respondError('Verification Code Invalid');
            }else{
                
                $auto_code = rand(9999,99999);
                $user->recovery_code = $auto_code; $user->save();

                $details = [
                    'title' => 'Your Password recovery verification code bellow this.',
                    'code' => $auto_code
                ];
          
                try {
                    Mail::to($user->email)->send(new PasswordRecover($details));
                } catch (\Exception $e) {
                    $this->respondError($e->getMessage());
                }
               
                return $this->respond('Verification code send to you email.');
            }
        }
        return $this->respondError('User Not Found');
    }

    public function changePassword(User $user)
    {
        $user->password = bcrypt(request('password')); $user->save();

        $details = [
            'title' => 'Your Password successfully changed.',
            'password' => 'New password is - '.request('password')
        ];

        try {
            Mail::to($user->email)->send(new PasswordRecover($details));
        } catch (\Exception $e) {
            $this->respondError($e->getMessage());
        }
        
        return $this->respond($user);
    }
}

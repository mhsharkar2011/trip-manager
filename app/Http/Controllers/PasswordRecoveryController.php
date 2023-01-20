<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\PasswordRecover;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PasswordRecoveryController extends Controller
{
    public function send_recovery_email()
    {
        $validation = Validator::make(
            request()->all(), 
            [
                'email' => 'required|email',
            ]
        );
        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }          
        
        $user = User::whereEmail(request('email'))->first();

        if ($user) {
            $user->recovery_code = random_int(999,9999); //4 digit code
            $user->save();

            try {
                $details = [
                    'title' => 'Please use the following code to reset your password',
                    'code' => $user->recovery_code
                ];
                Mail::to($user->email)->send(new PasswordRecover($details));

            } catch (\Exception $e) {
                logger('Sending password recovery email failed, error: ' . $e->getMessage());
            }
        }

        return $this->respond([], 
        'If the email exists in our system then an email has been sent with recovery steps.'
        );
    }

    public function update_password()
    {
        $validation = Validator::make(
            request()->all(), 
            [
                'email' => 'required|email',
                'code' => 'required',
                'new_password' => 'required|confirmed',
                'new_password_confirmation' => 'required',
            ]
        );
        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }          

        $user = User::whereEmail(request('email'))
            ->whererecoveryCode(request('code'))
            ->first();

        if (! $user) {
            return $this->respondBadRequest('The email and code did not match our records.');
        }            

        $user->password = bcrypt(request('new_password'));
        $user->recovery_code = null;
        $user->save();

        try {
            $details = [
                'title' => 'Your password was updated from the forgot password link.',
                // 'password' => 'Password is: ' . request('new_password') //better to not send it for security reasons
            ];
            Mail::to($user->email)->send(new PasswordRecover($details));

        } catch (\Exception $e) {
            logger('Password reset notification email failed, error: ' . $e->getMessage());
        }        

        return $this->respond('Your password have been changed');        
    }

} //class

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{

    public function get() {
        $user = auth()->user();

        if (! $user) {
            return $this->respondBadRequest('Could not find an user from current token');
        }

        return $this->respond($user);
    }
    
    public function update()
    {
        $user = auth()->user();

        if (! $user) {
            return $this->respondBadRequest('Could not find an user from current token');
        }

        $rules = User::validation_rules_for_update($user->id);
        unset($rules['role']);

        $validation = Validator::make(
            request()->all(), 
            $rules,
            User::validation_messages_for_update(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }  

        $user->update(request()->except('password', 'role'));

        return $this->respond($user, 'Profile updated');
    }

    public function change_password()
    {
        $validation = Validator::make(
            request()->all(), 
            [
                'old_password' => 'required|password:sanctum',
                'new_password' => 'required|confirmed',
                'new_password_confirmation' => 'required',
            ],
            [
                'old_password.password' => 'The old password did not match.'
            ]
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }  

        $user = auth()->user();
        if (! $user) {
            return $this->respondBadRequest('Could not find an user from current token');
        }

        $user->password = bcrypt(request('new_password'));
        $user->save();

        return $this->respond('Password have been changed');
    }

} //class

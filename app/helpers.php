<?php

use App\Models\User;

function is_prod() {
    return in_array(app()->environment(), ['prod', 'production']);
}

function is_non_prod() {
    return !is_prod();
}

function get_super_admin_email() {
    return User::getSuperAdmin('email');
}

function __getTokenForPostman() {
    $user = User::superAdmin()->first();
    $token = $user->tokens()->whereName('postman')->value('token');

    if (! $token) {
        $token = $user->createToken('postman')->plainTextToken;
    }

    return $token;
}
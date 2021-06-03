<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialiteLogin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'provider_id', 'user_details',
        'provider', 'nickname', 'name',
        'avatar', 'token', 'refreshToken',
        'expire',
    ];

    protected $guarded = [
        'id'
    ];
    protected $casts = [
        'user_details' => 'array',
    ];

    protected static function validation_rules() {
        return [];
    }

    protected static function validation_messages() {
        return [];
    }


}

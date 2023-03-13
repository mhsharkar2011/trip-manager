<?php

namespace App\Models;

use App\Devpanel\Models\baseModel;
use Illuminate\Database\Eloquent\Model;


class Customer extends baseModel
{
    protected $guarded = [
        'id'
    ];

    protected $appends = [
        // 'profile_photo_url',
        'full_name'
    ];

    public function getFullNameAttribute(){
        return $this->first_name.' '.$this->last_name;
    }


    protected static function validation_rules() {
        return [];
    }

    protected static function validation_messages() {
        return [];
    }

    protected static function validation_rules_for_update() {
        return self::validation_rules();
    }

    protected static function validation_messages_for_update() {
        return self::validation_messages();
    }  
    
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}

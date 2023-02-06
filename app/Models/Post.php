<?php

namespace App\Models;

use App\Devpanel\Models\baseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends baseModel
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded = [
        'id'
    ];

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

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id')->orWhere('parent_id',14);
    }


    
}

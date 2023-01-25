<?php

namespace App\Models;

use App\Devpanel\Models\baseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends baseModel
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

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class,'parent_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class,'post_id');
    }

}

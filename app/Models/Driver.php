<?php

namespace App\Models;

use App\Devpanel\Models\baseModel;
use Illuminate\Database\Eloquent\Model;


class Driver extends baseModel
{

    
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'drivers';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    //protected $fillable = ['first_name', 'last_name', 'username', 'password', 'avatar', 'driving_license', 'contact_number', 'address', 'user_id'];

    protected $guarded = [
        'id'
    ];    

    protected static function validation_rules() {
        return [
            "first_name"=>"required|max:20",
            "last_name"=>"required|max:20",
            "username"=>"required|max:20",
            "password"=>"required|min:8",
            "driving_license"=>"required|max:20",
            "contact_number"=>"required|max:14",
            "address"=>"required|max:255",
        ];
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

    
}

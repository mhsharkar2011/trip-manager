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
    protected $table = 'users';

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

    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class,'user_vehicle','user_id');
    }
    
}

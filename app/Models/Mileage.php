<?php

namespace App\Models;

use App\Devpanel\Models\baseModel;
use Illuminate\Database\Eloquent\Model;


class Mileage extends baseModel
{

    
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mileages';

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
    //protected $fillable = ['vehicle_id', 'total_mileage'];

    protected $guarded = [
        'id'
    ];    

    protected static function validation_rules() {
        return [
            "total_mileage"=>"required"
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

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class,'vehicle_id');
    }

    public function trips()
    {
        return $this->hasMany(Transport::class,'vehicle_id','vehicle_id');
    }
    
}

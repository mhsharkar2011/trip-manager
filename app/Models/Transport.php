<?php

namespace App\Models;

use App\Devpanel\Models\baseModel;
use Illuminate\Database\Eloquent\Model;


class Transport extends baseModel
{

    
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'trips';

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
    //protected $fillable = ['user_id', 'vehicle_id', 'from_area', 'to_area', 'mileages', 'rate'];

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

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class,'vehicle_id');
    }

    public function mileages()
    {
        return $this->hasMany(Mileage::class,'vehicle_id');
    }



    
}

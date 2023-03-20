<?php

namespace App\Models;

use App\Devpanel\Models\baseModel;

class Vehicle extends baseModel
{
    
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vehicles';

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
    //protected $fillable = ['sl_no', 'name', 'license_no', 'model'];

    protected $guarded = [
        'id'
    ];    

    protected static function validation_rules() {
        return [
            'name'=>'required|max:255',
            'model'=>'required|max:20',
            'tank_capacity'=>'required',
            'license_no'=>'required',
            'vehicle_type_id'=>'required',
        ];
    }

    protected static function validation_messages() {
        return [
            // 'sl_no.required'=>"Type Sl No",
            // 'name.required'=>"Type Name",
            // 'license_no.required'=>"Type License No",
            // 'model.required'=>"Type Model Name here",
        ];
    } 

    protected static function validation_rules_for_update() {
        return self::validation_rules();
    }

    protected static function validation_messages_for_update() {
        return self::validation_messages();
    }           

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class,'vehicle_type_id');
    }
    

    // Mileages
    public function mileage()
    {
        return $this->hasOne(Mileage::class,'vehicle_id');
    }

    // Users

    public function user()
    {
        return $this->belongsTo(User::class,'owner_id');
    }

    public function userVehicles()
    {
        return $this->belongsToMany(User::class,'user_vehicle','user_id')->withPivot('created_at');
    }

    public function fuels()
    {
        return $this->hasMany(Fuel::class,'vehicle_id');
    }
}

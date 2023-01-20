<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Vehicle extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    
    
    
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
            'sl_no'=>'required|max:255',
            'name'=>'required|max:255',
            'license_no'=>'required|max:255',
            'model'=>'required|max:255',
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
    
    public function fuelVehicle()
    {
        return $this->belongsToMany(Fuel::class,'fuel_vehicle')->withPivot('timestamps');
    }

    // Mileages
    public function mileages()
    {
        return $this->hasMany(Mileage::class);
    }

    // Users

    public function users()
    {
        return $this->belongsToMany(User::class,'user_vehicle','vehicle_id');
    }
}

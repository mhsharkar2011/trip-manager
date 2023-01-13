<?php

namespace App\Models;

use App\Devpanel\Models\baseModel;
use Illuminate\Database\Eloquent\Model;


class Fuel extends baseModel
{

    
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'fuels';

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
    //protected $fillable = ['fuel_id', 'start_fuel', 'end_fuel', 'total_fuel'];

    protected $guarded = [
        'id'
    ];    

    protected static function validation_rules() {
        return [
            'fuel_type_id'=>'required',
            'start_fuel'=>'required',
            'end_fuel'=>'required'
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

    public function fuelTypes()
    {
        return $this->belongsTo('App\Models\FuelType','fuel_type_id');
    }
    
}

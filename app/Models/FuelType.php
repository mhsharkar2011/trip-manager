<?php

namespace App\Models;

use App\Devpanel\Models\baseModel;


class FuelType extends baseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'fuel_types';

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
    //protected $fillable = ['name', 'created_at'];

    protected $guarded = [
        'id'
    ];    

    public $timestamps = false;

    protected static function validation_rules() {
        return [
            'name'=>'required|max:20',
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
    
    public function fuels()
    {
        return $this->hasMany(Fuel::class);
    }
}

<?php

namespace App\Devpanel\Models;

use App\Devpanel\Models\baseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Tenant extends baseModel
{
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tenants';

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
    //protected $fillable = ['name', 'user_id'];

    protected $guarded = [
        'id'
    ];    

    protected static function validation_rules() {
        return [
            'name' => 'required|unique:tenants,name'
        ];
    }

    protected static function validation_messages() {
        return [];
    } 

    protected static function validation_rules_for_update($tenant_id) {
        $rules = self::validation_rules();

        $rules['name'] = [
            'required',
            Rule::unique('tenants')->ignore($tenant_id),
        ];        
    }

    protected static function validation_messages_for_update() {
        return self::validation_messages();
    }           
    
}

<?php

namespace App\Models;

use App\Devpanel\Models\baseModel;
use Illuminate\Database\Eloquent\Model;


class HelpContent extends baseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'help_contents';

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
    protected $fillable = ['name', 'key', 'description', 'tenant_id'];

    protected $guarded = [
        'id'
    ];

    protected static function validation_rules() {
        return [
            "key" => 'required|unique:help_contents,key',
        ];
    }

    protected static function validation_messages() {
        return [];
    }

    protected static function validation_update_rules($id) {
        return [
            "key" => 'unique:help_contents,key,'.$id,
        ];
    }

    protected static function validation_rules_for_update($id) {
        return self::validation_update_rules($id);
    }

    protected static function validation_messages_for_update() {
        return self::validation_messages();
    }


}

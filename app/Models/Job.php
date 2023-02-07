<?php

namespace App\Models;

use App\Devpanel\Models\baseModel;
use Illuminate\Database\Eloquent\Model;


class Job extends baseModel
{

    
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'jobs';

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
    //protected $fillable = ['name', 'project_id'];

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

    public function project()
    {
        return $this->belongsTo('App\Models\project');
    }
 
    public function milestones()
    {
        return $this->hasMany(Milestone::class);
    }
    
}

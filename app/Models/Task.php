<?php

namespace App\Models;

use App\Devpanel\Models\baseModel;
use Illuminate\Database\Eloquent\Model;
use App\Devpanel\Models\Tenant;


class Task extends baseModel
{



    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tasks';

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
    protected $fillable = ['title', 'description', 'project_id', 'parent_id', 'sequence', 'due_date', 'time_estimate', 'tenant_id'];

    protected $guarded = [
        'id'
    ];

    protected $dates = [
        'due_date'
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
        return $this->belongsTo('App\Models\Project');
    }
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
    public function users() // assigned users in a tasks
    {
        return $this->belongsToMany(User::class, 'task_user')->withTimestamps();
    }
}

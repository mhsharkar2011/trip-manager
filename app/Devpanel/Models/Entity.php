<?php

namespace App\Devpanel\Models;

use Str;
use File;
use Schema;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    protected static function validation_rules() {
        return [
            'name' => 'required|unique:entities'
        ];
    }

    protected static function validation_messages() {
        return [];
    }

    protected function setNameAttribute($value) {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    protected function setSlugAttribute($value) {
        $this->attributes['slug'] = Str::slug($this->attributes['name']);
    }

    public function fields()
    {
        return $this->hasMany(Field::class);
        // return $this->hasMany(Entity::class, 'foreign_key', 'local_key');
    }

    public static function deleteMigrationAndDBTable($entity_name) {
        try {
            $name_singular = Str::singular(Str::studly($entity_name));
            $files = glob(app_path('Models/') . $name_singular.'.php'); 
            if (count($files) > 0 && File::exists($files[0])) {
                File::delete($files[0]);
            }
            
            $name_plural = Str::plural(Str::snake($entity_name));
            $files = glob(database_path() . '/migrations/*_create_'.$name_plural.'_table.php');
            if (count($files) > 0 && File::exists($files[0])) {
                File::delete($files[0]);
            }
    
            Schema::dropIfExists($name_plural);

            return true;
        } catch (\Exception $ex) {
            logger($entity_name . ' deleteMigrationAndDBTable failed, error: ' . $ex->getMessage());
        }
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        
        static::created(function($model) {
            $model->fields()->createMany(Field::getDefaultFields());
        });
    }

}

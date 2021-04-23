<?php

namespace App\Models;

use Str;
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

}

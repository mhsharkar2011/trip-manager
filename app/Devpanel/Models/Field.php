<?php

namespace App\Devpanel\Models;

use Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'meta' => 'array',
        'is_system_generated' => 'boolean',
    ];

    protected static function validation_rules() {
        return [
            'name' => 'required',
            'type' => 'required',
        ];
    }

    protected static function validation_messages() {
        return [];
    }

    protected function setNameAttribute($value) {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value, '_');
    }

    public static function getColumnTypeMapping($type) {
        return [
            'text' => 'string',
            'number' => 'integer',
            'image' => 'file',
            'file' => 'file',
            'option' => 'json',
            'tel' => 'string',
            'password' => 'string',
            'url' => 'string',
            'date' => 'datetime',
            'time' => 'datetime',
            'search' => 'string',

        ][$type] ?? 'string';
    }

    public static function getDefaultFields() {
        return [
            [
                'name' => 'Title',
                'type' => 'string',
                'type_label' => 'string',
                'position' => -1,
                'is_system_generated' => true,
            ],
        ];
    }


}

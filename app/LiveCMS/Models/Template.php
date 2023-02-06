<?php

namespace App\LiveCMS\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $table = 'live_cms_pages';

    protected $fillable = [
        'route',
        'path',
        'template',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        
        static::saving(function ($template) {
            if ($template->template) {
                $template->template_checksum = crc32($template->template);
            }
        });
    }

}

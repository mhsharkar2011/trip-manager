<?php

namespace App\Devpanel\Models;

use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

class Media extends BaseMedia
{
    protected $appends = [
        'full_url',
        'size_human_readable',
    ];
    
    public function getFullUrlAttribute()
    {
        return $this->getFullUrl();
    }

    public function getSizeHumanReadableAttribute()
    {
        return $this->human_readable_size;
    }
}
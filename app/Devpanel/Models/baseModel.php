<?php

namespace App\Devpanel\Models;

use Spatie\MediaLibrary\HasMedia;
use App\Devpanel\Models\FilterTrait;
use App\Devpanel\Traits\MultiTenancyTrait;
use App\Devpanel\Traits\RabbitMQPublishEloquentEventsTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class baseModel extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    use FilterTrait;
    use MultiTenancyTrait;
    use RabbitMQPublishEloquentEventsTrait;

    public function scopePaginateWrap($q, $items_per_page, $page)
    {
        return $q->paginate(
            $items_per_page, 
            $columns = ['*'], 
            $pageName = 'page', 
            $page
        );
    }

}

<?php

namespace App\Traits;

trait Comment {

    /**
     * Comments Polymorphic Relationship
     * @return mixed
     */
    public function comments()
    {
        return $this->morphMany(\App\Devpanel\Models\Comment::class, 'commentable');
    }
}

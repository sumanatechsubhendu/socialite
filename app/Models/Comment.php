<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

Relation::enforceMorphMap([
    'posts' => Post::class,
    'videos' => Video::class,
    // Add more morphable types as needed
]);

class Comment extends Model
{
    protected $fillable = ['body'];

    public function commentable()
    {
        return $this->morphTo();
    }
}

<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class PostLike extends Model
{
    protected $table = "posts_likes";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'count', 'post_id',
    ];

    public $timestamps = false;
}

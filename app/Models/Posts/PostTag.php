<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    protected $table = "posts_tags";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'post_id'
    ];

    public $timestamps = false;
}

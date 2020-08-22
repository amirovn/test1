<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class ArticleLike extends Model
{
    protected $table = "articles_likes";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'count', 'article_id',
    ];

    public $timestamps = false;
}

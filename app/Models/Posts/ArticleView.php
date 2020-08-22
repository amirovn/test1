<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class ArticleView extends Model
{
    protected $table = "articles_views";

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

<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{
    protected $table = "articles_tags";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'article_id'
    ];

    public $timestamps = false;
}

<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class ArticleComment extends Model
{
    protected $table = "articles_comments";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'article_id',
    ];

    public $timestamps = false;

}

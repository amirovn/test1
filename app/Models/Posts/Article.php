<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Article extends Model
{
    protected $table = "articles";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'image', 'created_at', 'updated_at'
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(ArticleComment::class, 'article_id', 'id');
    }

    public function likes(): HasOne
    {
        return $this->hasOne(ArticleLike::class, 'article_id', 'id');
    }

    public function tags(): HasMany
    {
        return $this->hasMany(ArticleTag::class, 'article_id', 'id');
    }

    public function views(): HasOne
    {
        return $this->hasOne(ArticleView::class, 'article_id', 'id');
    }
}

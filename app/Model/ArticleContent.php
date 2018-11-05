<?php

namespace App\Model;

use Illuminate\Database;
use Eloquent;

class ArticleContent extends Eloquent
{
    protected $table = 'blog_articles';

    protected $fillable = [
        'id',
        'article_id',
        'content',
        'created_at',
        'updated_at',
        'one_article_id',
    ];

    public function belongsToManyContent()
    {
        return $this->belongsToMany('App\Content', 'content', 'id', 'article_id');
    }
}
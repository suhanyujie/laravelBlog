<?php

namespace App\Model\Article;

use Illuminate\Database\Eloquent\Model;
use App\Model\ArticleContent;

class Tags extends Model
{
    //表名
    public $table = 'blog_tags';
    public $fillable = [
        'id','tag_name','desc','is_del',
    ];




}// end of class

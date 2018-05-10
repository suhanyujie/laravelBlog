<?php

namespace App\Model\Article;

use Illuminate\Database\Eloquent\Model;
use App\Model\ArticleContent;

class Tags extends Model
{
    //表名
    public $table = 'blog_tags';
    public $fillable = [
        'id', 'tag_name', 'desc', 'is_del',
    ];


    /**
     * @desc:根据标签id获取关联的文章id
     * @author:Samuel Su(suhanyu)
     * @date:17/2/27
     */
    public function getRelateInfoByTagId() {
        return $this->hasMany('App\Model\Article\RelateTags','tag_id','id');
    }



}// end of class

<?php

namespace App\Model\Article;

use Illuminate\Database\Eloquent\Model;
use App\Model\Article\Tags;

class RelateTags extends Model
{
    public $table = 'blog_relate_tags';
    public $fillable = [
        'id','article_id','tag_id',
    ];

    /**
     * 关联获取标签的信息
     */
    public function tagInfo(){
        return $this->belongsTo('App\Model\Article\Tags','tag_id','id');
    }


}// end of class

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'blog_content';
    protected $fillable = array('id','article_id','content','created_at','updated_at');
    protected $dates = ['publish_date'];


    /**
     * Get the article that owns the Content.
     */
    public function article()
    {
        return $this->belongsTo('App\Article');
    }
    /**
     *  获取多个文章对应的content
     */
    public static function scopeContents($query,$idArr) {
        $idStr = '('.implode(',',$idArr).')';
    
        return $query->where('article_id','>','60');
    }
    
}# 类-结束

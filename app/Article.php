<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Article extends Model
{
	protected $table = 'blog_articles';
	protected $fillable =array('created_at','updated_at','title','class_id',
			'subclass_id','publish_date','publish_status','status','pv',
		);
	protected $dates = ['publish_date'];

	/**
	 * @param $date
	 * setPublishDateAttribute/setTitleAttribute
	 */
	public function setPublishDateAttribute($date){
		#$this->attributes['publish_date'] = Carbon::createFromFormat('Y-m-d H:i:s',$date);
		#$this->attributes['publish_date'] = strtotime($date);
		$this->attributes['publish_date'] = time();
	}
	/**
	 * 发布的条件限制
	 * scope+方法名
	 */
	public function scopePublished($query){
		return $query->where('publish_date','<=',time());
	}

	public function user(){
		return $this->belongsTo('App\User');
	}
	/**
	 * Get the content record associated with the article.
	 */
	public function hasOneContent()
	{
		return $this->hasOne('App\Content','article_id','id');
	}
	
	/**
	 * 多个文章 并获取content 使用with的方式
	 */
	public function content(){
	    return $this->belongsTo('App\Content','id','article_id');
	}
	/**
	 * 获取文章的关联标签,使用with方式
	 */
    public function tags(){
        return $this->hasMany('App\Model\Article\RelateTags','article_id','id');
    }

}// 类结束符
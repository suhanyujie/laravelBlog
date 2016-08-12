<?php 
namespace App\Model;

use Illuminate\Database;
use Eloquent; 

class ArticleContent extends Eloquent {
    protected $table = 'blog_articles';
    
    public function belongsToManyContent(){
        
        return $this->belongsToMany('App\Content', 'content', 'id', 'article_id');
    }
    
  
    
}
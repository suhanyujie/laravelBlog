<?php
namespace MyBlog\Repositories;

use App;

class ArticleRepository {

    /* 注入的Article Model */
    protected $article;

    /**
     * ArticleRepository constructor.
     * @param Article $article
     */
    public function __construct(App\Article $article){
        $this->article = $article;
    }

    public function getLatestArticles(){
        return $this->article->where('is_del','<',1)->orderBy('id','DESC')->get();
    }


}
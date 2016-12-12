<?php
/**
 * Created by PhpStorm.
 * User: suhanyu
 * Date: 16/10/11
 * Time: 上午8:28
 */

namespace App\Api\Controllers;
use App\Api\Transformers\ArticleTransformer;
use App\Article;

class ArticleController extends BaseController
{
    public function index(){
        $articles = Article::latest()->take(10)->get();

        return $this->collection($articles, new ArticleTransformer());
    }

}
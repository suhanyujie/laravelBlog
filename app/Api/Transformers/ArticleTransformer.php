<?php
/**
 * Created by PhpStorm.
 * User: suhanyu
 * Date: 16/10/11
 * Time: 上午8:49
 */

namespace App\Api\Transformers;
use App\Article;

use League\Fractal\TransformerAbstract;

class ArticleTransformer extends TransformerAbstract
{
    public function transform(Article $article){

        return [
            'title'=>$article['title'],
        ];
    }

}
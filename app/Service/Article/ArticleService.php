<?php
/**
 * Created by PhpStorm.
 * User: suhanyu
 * Date: 18/11/5
 * Time: 上午8:43
 */

namespace App\Service\Article;

use App\Article as ArticleModel;
use App\Service\BaseService;

class ArticleService extends BaseService
{
    /**
     * @desc 获取文章详情列表
     */
    public function getList($paramArr=[])
    {
        $options = [
            'publish_status' => 1,
            'offset'         => 0,
            'limit'          => 1
        ];
        $options = array_merge($options, $paramArr);
        $articles = ArticleModel::where()
            ->offset()->limit()->get();
        if ($articles->count()<1)return [];
        $articles = $articles->map(function ($item) {

        });

        return $articles;
    }
}

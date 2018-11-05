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

        ];
        $options = array_merge($options, $paramArr);

    }
}

<?php
/**
 * @desc: 处理tag相关的数据
 * Created by PhpStorm.
 * User: suhanyu
 * Date: 17/4/2
 * Time: 下午6:59
 */


namespace MyBlog\Repositories;


use App\Model\Article\Tags;

class Rtag
{
    protected $tag;

    /**
     * ArticleRepository constructor.
     * @param Article $article
     */
    public function __construct(Tags $tag){
        $this->tag = $tag;
    }


    /**
     * @desc: 根据tag的名称,查看tag是否存在
     * @author:Samuel Su(suhanyu)
     * @date:17/4/2
     * @param String $param
     * @return Array 
     */
    public function checkTagExists($tagName) {
        $flag = $this->tag->where('tag_name','const')->get()->count();
        return $flag;
    }




}
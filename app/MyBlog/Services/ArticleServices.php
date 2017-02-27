<?php
/**
 * Created by PhpStorm.
 * User: suhanyu
 * Date: 16/10/28
 * Time: 上午11:51
 */

namespace MyBlog\Services;


use App\Model\Article\Tags;

class ArticleServices extends BaseServices
{

    /**
     * @desc 处理文章的相关标签
     */
    public function dealTags($dataArr,Tags $tags){
        $tagIds = $tmpArr = [];
        $dataArr->map(function($item){
            $tagIdArr = $item->tags->pluck('tag_id');
            $item->tagIds = $tagIdArr;
            $this->getTagInfo($item);
        });
    }

    /**
     * @desc 获取tag的name等信息
     */
    public function getTagInfo($itemObj){
        $tagModel = new Tags();
        $ids = $itemObj->tagIds->toArray();
        $itemObj->tagInfo = $tagModel->whereIn('id',$ids)->get();
    }



}// end of class
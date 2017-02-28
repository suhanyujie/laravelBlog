<?php
/**
 * Created by PhpStorm.
 * User: suhanyu
 * Date: 16/10/28
 * Time: 上午11:51
 */

namespace MyBlog\Services;


use App\Article;
use App\Model\Article\Tags;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

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

    /**
     * @desc:根据标签获取文章列表
     * @author:Samuel Su(suhanyu)
     * @date:17/2/27
     */
    public function getListByTag($id) {
        $tagModel = new Tags();
        $res = $tagModel->find($id)->getRelateInfoByTagId()->get();
        $res = $res->pluck('article_id');
        $res = $this->getArticleInfoByArticleIds($res);
        return $res;
    }
    
    /**
     * @desc:根据文章id获取信息,返回对应的列表
     * @author:Samuel Su(suhanyu)
     * @date:17/2/28
     */
    public function getArticleInfoByArticleIds($articleIdArr) {
        $articleIdArr = $articleIdArr->toArray();
        $articleInfo = DB::table('blog_articles')->whereRaw('id in ('.implode(',',$articleIdArr).')')->get();
        $contentArr = $this->getContentByArticleIds($articleIdArr);
        foreach($articleInfo as $k=>$v){
            $v->content = $contentArr[$v->id];
        }
        return $articleInfo;
    }

    /**
     * @desc:根据文章id获取对应的文章内容
     * @author:Samuel Su(suhanyu)
     * @date:17/2/28
     */
    public function getContentByArticleIds($articleIdArr) {
        if(!$articleIdArr)return [];
        $contentArr = DB::table('blog_content')->whereRaw('article_id in ('.implode(',',$articleIdArr).')')->get();
        $tmpArr = [];
        foreach($contentArr as $k=>$v){
            $tmpArr[$v->article_id] = $v->content;
        }
        return $tmpArr;
    }



}// end of class
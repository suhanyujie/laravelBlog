<?php
/**
 * Created by PhpStorm.
 * User: suhanyu
 * Date: 16/10/28
 * Time: 上午11:51
 */

namespace MyBlog\Services;


use App\Article;
use App\Model\Article\RelateTags;
use App\Model\Article\Tags;
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
        if(!$id)return [];
        $tagModel = new Tags();
        $res = $tagModel->findOrFail($id)->getRelateInfoByTagId()->get();
        $articleIdArr = $res->pluck('article_id');
        $res = $this->getArticleInfoByArticleIds($articleIdArr);
        return $res;
    }
    
    /**
     * @desc:根据文章id获取信息,返回对应的列表
     * @author:Samuel Su(suhanyu)
     * @date:17/2/28
     */
    public function getArticleInfoByArticleIds($articleIdArr) {
        if(!$articleIdArr)return [];
        $articleIdArr = $articleIdArr->toArray();
        $articleInfo = DB::table('blog_articles')->whereRaw('id in ('.implode(',',$articleIdArr).')')->get();
        $contentArr = $this->getContentByArticleIds($articleIdArr);
        foreach($articleInfo as $k=>$v){
            $articleInfo[$k] = (array)$articleInfo[$k];
            $v = (array)$v;
            $articleInfo[$k]['content'] = $contentArr[$v['id']];
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

    /**
     * @desc: 更新时,处理标签的逻辑
     * @author:Samuel Su(suhanyu)
     * @date:17/4/2
     * @param String $param
     * @return Array
     */
    public function dealTag($tagArr, $docId) {
        // 先取出这个文章的关联标签,和更新后的标签对比
        $relateTags = RelateTags::where('article_id', $docId)->with('tagInfo')->get();
        $oldTagArr = [];
        $relateTags->map(function($item, $key)use(&$oldTagArr){
            $oldTagArr[$item->tagInfo->id] = $item->tagInfo->tag_name;
        });
        $oldTagArrFlip = array_flip($oldTagArr);
        // 求同存异
        // 在旧的标签中 不存在,就要(新增标签|新增关联)
        $newTags = array_diff($tagArr, $oldTagArr);
        // 在更新后的标签中不存在的,旧标签群中有的,则需要删除
        $toDeleteTags = $oldTagArr ?
                array_diff($oldTagArr, $tagArr) : [];

        if($newTags){
            foreach($newTags as $k=>$row){
                if(!$row)continue;
                $res = Tags::where('tag_name',$row)->get();
                $res = $res->first();
                if( $res && $res->count() > 0 ){
                    $tagInsertId = isset($oldTagArrFlip[$row]) ? $oldTagArrFlip[$row] : 0;
                    if(!$tagInsertId)throw new \ErrorException('there is something error--'.__CLASS__);
                }else{
                    $tags = ['tag_name'=>$row];
                    $tagInsertId = Tags::create($tags)->id;
                }
                // 标签关联
                $relateTags = ['article_id'=>$docId,'tag_id'=>$tagInsertId,];
                RelateTags::create($relateTags);
            }
        }
        if($toDeleteTags){
            foreach($toDeleteTags  as $k=>$row){
                if(!isset($oldTagArrFlip[$row]))throw new \ErrorException('there is something error--'.__CLASS__);
                RelateTags::where('article_id', $docId)->where('tag_id', $oldTagArrFlip[$row])->delete();
            }
        }
    }



}// end of class
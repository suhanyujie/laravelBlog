<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use MyBlog\Repositories\ArticleRepository;
use App\Article;
use App\Content;
use Carbon\Carbon;
use App\Model;
use App;
use MyBlog\Services\ArticleServices;
use MyBlog\Services\PageService;
use Predis\Client;
use Illuminate\Support\Facades\DB;

class ArticlesController extends Controller
{
    protected $page;
    protected $articleService;

    public function __construct(PageService $pageObj)
    {
        $this->page = $pageObj;
        $this->articleService = new ArticleServices();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$a = new ArticleRepository(new \App\Article);
        //return [$request->json()];
        // 一页多少文章
        $pageNum = 10;
        $userInfo = \Auth::user();
        $data = [];
        $data['articles'] = Article::latest()->published()->get();
        $data['userInfo'] = $userInfo;
        $dataArticles = array();
        $curPage = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $cacheKey = 'laravel:articles:index:page:'.$curPage;
        if( !Cache::has($cacheKey) || ($request->refresh==1) ){
            //$dataArticles = \App\Article::latest()->take($pageNum)->with('content')->get()->toArray();
            $dataArticles = App\Article::latest()->with(['content','tags'])->paginate($pageNum);
            $dealTagObj = new ArticleServices();
            $dealTagObj->dealTags($dataArticles,new Model\Article\Tags());
            $dataArticles = $dataArticles->toArray();
            Cache::put($cacheKey,$dataArticles,3600);
        }else{
            $dataArticles = Cache::get($cacheKey);
        }
        //获取标签
        $tags = $this->articleService->getTagList([
            'limit' => 18,
        ]);
        //获取最新文章2个
        $data['latestArticles'] = $this->articleService->getLastestArticles();
        $data['articles'] = $dataArticles;
        $data['articles']['pageHtml'] = $this->page->getPageHtml($dataArticles,$request);
        $data['tags'] = $tags;
        //var_dump($data);exit();

        return view('articles.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Auth::check() == false){
            return redirect('/auth/login');
        }
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CreateArticleRequest $request)
    {
        // 接受post过来的数据
        $this->validate($request,['title'=>'required','content'=>'required']);
        $input = $request->except('_token');
        // 存入数据库
        $input['publish_date'] = time();
        // 去重,针对重复刷新,可以发布多次一样的文章的问题
        if(Article::where('title',$input['title'])->get()->count() > 0){
            exit('<h1>文章已经发布过了!</h1>');
        }
        $insertId = Article::create($input)->id;
        $contentInsert = array();
        // 新创建的文章id
        $contentInsert['article_id'] = $insertId;
        $contentInsert['content'] = $input['content'];
        $res1 = Content::create($contentInsert);
        // tags的存储
        if(isset($input['article_tags'])){
            $addTagsArr = explode(',',$input['article_tags']);
            $tags = $relateTags = [];
            if($addTagsArr){
                foreach($addTagsArr as $k=>$v){
                    $tags = ['tag_name'=>$v];
                    $tagExist = Model\Article\Tags::where('tag_name',$v)->take(1)->get();
                    if( $tagExist->count() > 0 ){
                        $tagInsertId = $tagExist->first()->id;
                    } else {
                        $tagInsertId = Model\Article\Tags::create($tags)->id;
                    }
                    $relateTags = ['article_id'=>$insertId,'tag_id'=>$tagInsertId,];
                    Model\Article\RelateTags::create($relateTags);
                }
            }
        }
        $curPage = 1;
        $cacheKey = 'laravel:articles:index:page:'.$curPage;
        Cache::forget($cacheKey);
        // 重定向
        return redirect('/articles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Article::findOrFail($id);
        // 文章pv数的更新
        $newPv = $data->pv+1;
        Article::find($id)->update(['pv'=>$newPv,]);
        $data->content = Article::find($id)->hasOneContent->content;

        if($data->id > 127){
            return view('articles.showMd',compact('data'));
        }
        return view('articles.showUeditor',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(\Auth::check() == false){
            return redirect('/auth/login');
        }
    	$articles = Article::findOrFail($id);
        $articles->content = Article::find($id)->hasOneContent->content;
        $tags = Model\Article\RelateTags::latest()->where('article_id', $id)->with('tagInfo')->get();
        $articleTags = array();
        foreach($tags as $k=>$row){
            $articleTags[] = $row->tagInfo->tag_name;
        }
        $articles->articleTags = implode(',', $articleTags);
    	#dd($articles);
        if($id > 127){
            return view('articles.edit',compact('articles'));
        }
        return view('articles.editUeditor',compact('articles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\CreateArticleRequest $request, $id)
    {
        if(\Auth::check() == false){
            return redirect('/auth/login');
        }
        $input = $request->except('_token');
        // 更新标题信息到文章主表中
        // $articles = Article::findOrFail($id)->update(['publish_date'=>time(),'title'=>$request->title]);
        // 更新时,更新tag的数据  开发中... 20170204
        if(isset($input['article_tags'])){
            $addTagsArr = explode(',',$input['article_tags']);
            $tags = $relateTags = [];
            $this->articleService->dealTag($addTagsArr, $id);
        }
        // 更新到content表中
        $contentArr = ['article_id'=>$id, 'content'=>$input['content'] ];
        $content = Content::where('article_id',$id)->update($contentArr);

        return redirect('/articles/');
    }

    /**
     * @desc:
     * @date:17/2/27
     * @author:Samuel Su(suhanyu)
     */
    /**
     * 功能:
     */
    public function tagList(Request $request, $id) {
        $dataList = $this->articleService->getListByTag($id);

        return view('articles.list')->with('dataList',$dataList);
    }

    // 全文分词搜索 1-1
    public function search(Request $request){
        //$keyword = '服务器';
        //$keywords = $requests->get('keywords');
        //$requests = $request;
        //return $requests->get('keywords')->toString();
        $keyword = $request->get('keywords');
        //$keyword = $keywords ? addslashes($keywords) : addslashes($_REQUEST['keywords']);
        //header("content-type:text/html;charset=utf-8");
        // include('/home/tmp/tool/coreseek-3.2.14/csft-3.2.14/api/sphinxapi.php');
        /*
        $result = $searchList = array();
        */
        if (0) {
            $s = new \SphinxClient;
            $s->setServer("localhost", 9312);
            $s->setArrayResult(true);
            // $s->setSelect();
            $s->setMatchMode(SPH_MATCH_ALL);
            $result = $s->query($keyword, 'test1');
            // 获取检索到的文章id
            $idArr = [];
            $data = $titleArr = [];
            if (isset($result['matches']) && is_array($result['matches'])) {
                foreach ($result['matches'] as $k => $v) {
                    $idArr[] = $v['attrs']['article_id'];
                }
                $idStr = implode(',',$idArr);
               // 查找文章
               $data['articles'] = \DB::table('blog_articles')->whereRaw('id in ('.$idStr.')')->get();
               $contentArr =  \DB::table('blog_content')->whereRaw('article_id in ('.$idStr.')')->get();
               if($contentArr){
                   $newContentArr = array();
                   foreach($contentArr as $k=>$v){
                       $newContentArr[$v->article_id] = $v->content;
                   }
                   $contentArr = $newContentArr;
                   unset($newContentArr);
               }
               if($data['articles']){
                   foreach($data['articles'] as $k=>$v){
                       $searchList[$k]['id'] = $v->id;
                       $searchList[$k]['title'] = $v->title;
                       $searchList[$k]['content'] = $contentArr[$v->id];
                   }
               }
               //var_dump($searchList);exit();
               return view('articles.search',compact('searchList'));
           }
       }else{
           $searchList[0]['message'] = '请输入要查询的关键词~';
           return;
       }

       return view('articles.search',compact('searchList'));
       //var_dump(rand(1000,9999));
   }
   /**
    * 博客数据库备份
    */
    public function backup(){
        $passwdPart = '6852';
        $command = 'cd /data/backup/;ls;/usr/local/mysql/bin/mysqldump -uroot -p'.$passwdPart.'432 --opt --databases laravel > /data/backup/laravel_'.date('Y-m-d H:').'.bk';
        system($command,$return);
        echo '<pre>';
        var_dump($return);
        echo '</pre>';
        echo '备份成功! <a href="/"> 回到首页 </a>';
        exit();
    }
    /**
     * 留言
     */
    public function leaveWords(){

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function test1(){
        return view('articles/admin/public/siderbar');
    }
}

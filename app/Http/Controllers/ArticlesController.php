<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use MyBlog\Repositories\ArticleRepository;

use App\Article;
use App\Content;
use Carbon\Carbon;
use App\Model;
use App;

use Predis\Client;
use Illuminate\Support\Facades\DB;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$a = new ArticleRepository(new \App\Article);
        //var_dump($a->getLatestArticles());exit();
        // 一页多少文章
        $pageNum = 10;
        $userInfo = \Auth::user();
        $data = array();
        $data['articles'] = Article::latest()->published()->get();
        $data['userInfo'] = $userInfo;
        $dataArticles = array();
        $curPage = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;

        $cacheKey = 'laravel:articles:index:page:'.$curPage;
        $redis = new \Predis\Client(array(
                'host' => '127.0.0.1',
                'port' => 6379,
        ));
        $dataArticles = $redis->get($cacheKey);
        if(!$dataArticles  ){
            //$dataArticles = \App\Article::latest()->take($pageNum)->with('content')->get()->toArray();
            $dataArticles = App\Article::latest()->with('content')->paginate($pageNum)->toArray();
            //var_dump($dataArticles);exit();
            $redis->setex($cacheKey,3600*12,serialize($dataArticles));
        }else{
            $dataArticles = unserialize($dataArticles);
        }
        
        $data['articles'] = $dataArticles;
        //var_dump($data);exit(); 
        // $articleArr[0]['relations']['content']['content']

        return view('articles.index')->with('data',$data);
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
        # var_dump($request->all()); exit();
        # 接受post过来的数据
        $this->validate($request,['title'=>'required','content'=>'required']);
        $input = $request->except('_token');
        # 存入数据库
        #$input['publish_date'] = time();
        $insertId = Article::create($input)->id;
        $contentInsert = array();
        # 新创建的文章id
        $contentInsert['article_id'] = $insertId;
        $contentInsert['content'] = $input['content'];
        $res1 = Content::create($contentInsert);
        # tags的存储  // 功能正在开发中..
        if(isset($input['article_tags']) && false){
            $addTagsArr = explode(',',$input['article_tags']);
            $tags = $relateTags = [];
            if($addTagsArr){
                foreach($addTagsArr as $k=>$v){
                    $tags = ['tags_name'=>$v];
                    $tagInsertId = DB::table('blog_tags')->insert(array($tags));

                    $relateTags = ['article_id'=>$insertId,'tag_id'=>$tagInsertId,];
                    DB::table('blog_relate_tags')->insert(array($relateTags));
                }
            }
        }
        #dd($res1);
        #Article::create($contentInsert);
        $redis = new \Predis\Client();
        $curPage = 1;
        $cacheKey = 'laravel:articles:index:page:'.$curPage;
        $redis->set($cacheKey,'');
        #重定向
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
        $data->content = Article::find($id)->hasOneContent->content;
        #dd($data->created_at->diffForHumans());
        return view('articles.show2',compact('data'));
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
    	#dd($articles);
        return view('articles.edit',compact('articles'));
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
        $articles = Article::findOrFail($id)->update(['publish_date'=>time(),]);
        #$articles->update($request->all());
        // 更新到content表中
        $contentArr = ['article_id'=>$id,'content'=>$request->content,];
        //dd($contentArr);
        $content = Content::where('article_id',$id)->update($contentArr);
        //dd($content);
        #$content->update($contentArr);

        return redirect('/articles/');
    }
    // 全文分词搜索
    public function search(Request $request){
        //$keyword = '服务器';
        //$keywords = $requests->get('keywords');
        //$requests = $request;
        //return $requests->get('keywords')->toString();
        $keyword = $request->get('keywords');
        //$keyword = $keywords ? addslashes($keywords) : addslashes($_REQUEST['keywords']);
        //header("content-type:text/html;charset=utf-8");
        // include('/home/tmp/tool/coreseek-3.2.14/csft-3.2.14/api/sphinxapi.php');
        $s = new \SphinxClient;
        $s->setServer("localhost", 9312);
        $s->setArrayResult(true); 
        // $s->setSelect();
        $s->setMatchMode(SPH_MATCH_ALL);
        $result = $searchList = array();
        if($keyword){
            $result = $s->query($keyword, 'test1');
            // 获取检索到的文章id 
            $idArr = array();
            $data = $titleArr = array();
            if(isset($result['matches']) && is_array($result['matches'])){
                foreach ($result['matches'] as $k=>$v){
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
        //return '';
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

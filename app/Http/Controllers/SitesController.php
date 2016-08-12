<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;

use \Libs;

class SitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        echo 'This is SitesCroller~';
    }
    /**
     * 测试用的about方法
     * 目前用于将图片上传至贴图库 suhy 20160623
     */
    public function about(Request $request){
        // 处理 文件上传
        if(!defined('MY_ACCESSKEY')){ //获取地址:http://open.tietuku.cn/manager
            define('MY_ACCESSKEY', 'be2464de338b26a0d278f638b671e54065897f2e');
        }
        if(!defined('MY_SECRETKEY')){
            define('MY_SECRETKEY', 'da39a3ee5e6b4b0d3255bfef95601890afd80709');//获取地址:http://open.tietuku.cn/manager
        }
        $photoId = 1194744;
        $file = $request->get('file');
        //$file = addslashes($_POST['file']);
        $data = base64_decode(preg_replace('#data:image/[^;]*;base64,#', '', $file));
        $filePath = '/www/html/laravel/html/blog/public/test/'.uniqid('blogimg').'.png';
        file_put_contents($filePath, $data);
        //$filePath = '/www/html/laravel/html/blog/public/favicon.ico';
        $ttk=new Libs\Tietuku\TietukuClient(MY_ACCESSKEY,MY_SECRETKEY);
        //if(!$_FILES)return ['code'=>0,'msg'=>'没有上传文件'];
        //$res = $ttk->uploadFile($photoId,$_FILES['file']['tmp_name']);
        $res = $ttk->uploadFile($photoId,$filePath);
        return $res;
        //echo $res;
    }
    /**
     * 测试方法：contact
     */
    public function contact(){
        $people = ['Suhanyu','Huyiping','Fujunyao'];
        return view('sites.contact',compact('people'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}

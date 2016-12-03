<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/test-sql', function() {
    //DB::enableQueryLog();
    //$articles = App\Article::create();
    //return response()->json(DB::getQueryLog());
});

Route::get('/','ArticlesController@index');
//Route::get('/about','SitesController@about');
Route::post('/upfile','SitesController@about');
//Route::post('/upfile',function(){
//    return json_encode(['code'=>1,'msg'=>'success!']);
//});
//Route::get('/contact','SitesController@contact');

//Route::get('admin', function () {
//	return view('admin_template');
//});

/*Route::get('/articles','ArticlesController@index');
Route::get('/articles/create','ArticlesController@create');
Route::get('/articles/{id}','ArticlesController@show');
Route::post('/articles','ArticlesController@store');
Route::get('/articles/{id}/edit','ArticlesController@edit');*/

# 搜索路由
Route::get('/articles/search','ArticlesController@search');
# 留言路由
//Route::get('/articles/leaveWords','\App\Http\Controllers\Article\LeaveMessageController@create');
Route::resource('/articles/message','\App\Http\Controllers\Article\LeaveMessageController');

//Route::get('/articles/testmessage',function(){
//    return view('articles.messageOld');
//});

// 文章的新增编辑等等
Route::resource('articles','ArticlesController');
// 数据备份路由
Route::get('/articles/backup','ArticlesController@backup');

Route::get('auth/login','Auth\AuthController@getLogin');
Route::post('auth/login','Auth\AuthController@postLogin');

Route::get('auth/register','Auth\AuthController@getRegister');
Route::post('auth/register','Auth\AuthController@postRegister');

Route::get('auth/logout','Auth\AuthController@getLogout');

// API 路由配置
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Api\Controllers'], function ($api) {
        $api->post('user/login','AuthController@authenticate');
        $api->get('articles','ArticleController@index');
    });

});



/*
Route::get('/', function () {
    return view('sites.index');
});*/
Route::get('/test1', function(){
    $arr1 = [[
        'key1'=>'value1',
        'key2'=>[
            ['key2_1'=>'value2_1','price'=>'123',],
            ['key2_2'=>'value2_2','price'=>'487',],
        ],

    ]];
    $startTime = microtime(true);
    $sum = 0;
    for($i=0;$i<100000;$i++){
//        collect($arr1)->flatMap(function($ele){
//            return  $ele['key2'];
//        })->pluck('price')->sum();
        // 原生的foreach效率高了35.7倍
        foreach($arr1 as $k=>$order){
            foreach($order['key2'] as $v){
                $sum += $v['price'];
            }
        }
    }
    $endTime = microtime(true);

    return round(($endTime-$startTime),4);
});

Route::resource('/admin', '\App\Http\Controllers\Article\AdminController');

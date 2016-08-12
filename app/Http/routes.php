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


Route::resource('articles','ArticlesController');
// 数据备份路由
Route::get('/articles/backup','ArticlesController@backup');

Route::get('auth/login','Auth\AuthController@getLogin');
Route::post('auth/login','Auth\AuthController@postLogin');

Route::get('auth/register','Auth\AuthController@getRegister');
Route::post('auth/register','Auth\AuthController@postRegister');

Route::get('auth/logout','Auth\AuthController@getLogout');




/*
Route::get('/', function () {
    return view('sites.index');
});*/
Route::get('/test1', 'ArticlesController@test1');
Route::resource('/admin', '\App\Http\Controllers\Article\AdminController');

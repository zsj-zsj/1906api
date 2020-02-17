<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('phpinfo', function () {
    phpinfo();
});


//Api
Route::prefix('/api')->group(function(){
    Route::get('/userinfo','Api\UserController@info');
    Route::post('/reg','Api\UserController@reg');
});

Route::get('goods/index','GoodsController@index');
Route::get('goods/goodslist','GoodsController@goodslist');

Route::get('goods/brand','GoodsController@brand');




//测试
Route::prefix('/test')->group(function(){
    Route::get('/redis','Testcontroller@testredis');   //redis
    Route::get('/file_get_contents','Testcontroller@file_get_contents');   //file_get_contents  get
    Route::get('/curl','Testcontroller@curl');   //curl   get    
    Route::get('/curlPost','Testcontroller@curlPost');
    Route::get('/Guzzle','Testcontroller@Guzzle');  //Guzzle   get
    Route::get('/GuzzlePost','Testcontroller@GuzzlePost');  //Guzzle    Post
    
    Route::post('/post1','Testcontroller@post1');
    Route::post('/post2','Testcontroller@post2');
    Route::post('/post3','Testcontroller@post3');
    Route::post('/upload','Testcontroller@upload');

    Route::post('/guzzleget','Testcontroller@guzzleget');
    Route::post('/guzzlepost1','Testcontroller@guzzlepost1');
    Route::post('/guzzleupload','Testcontroller@guzzleupload');
    Route::post('/guzzlejson','Testcontroller@guzzlejson');
});


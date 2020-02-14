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




//测试
Route::prefix('/test')->group(function(){
    Route::get('/redis','Testcontroller@testredis');   //redis
    Route::get('/file_get_contents','Testcontroller@file_get_contents');   //file_get_contents  get
    Route::get('/curl','Testcontroller@curl');   //curl   get  
    Route::get('/Guzzle','Testcontroller@Guzzle');  //Guzzle   get
});


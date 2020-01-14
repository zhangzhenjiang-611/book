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
//用户模块
//用户注册页面
Route::get('/register','\App\Http\Controllers\RegisterController@index');
//用户注册行为
Route::post('/register','\App\Http\Controllers\RegisterController@register');
//用户登录页面
Route::get('/login','\App\Http\Controllers\LoginController@index');
//用户登录行为
Route::post('/login','\App\Http\Controllers\LoginController@login');
//用户退出行为
Route::get('/logout','\App\Http\Controllers\LoginController@logout');
//个人主页
Route::get('/user/{id}','\App\Http\Controllers\UserController@index');
//个人设置页面
Route::get('/user/me/setting','\App\Http\Controllers\UserController@setting');
//个人设置操作
Route::post('/user/me/setting','\App\Http\Controllers\UserController@settingStore');
Route::get('/', function () {
    return view('welcome');
});
//文章列表页
Route::get('/posts','\App\Http\Controllers\PostController@index');
//创建文章
Route::get('/posts/create','\App\Http\Controllers\PostController@create');
Route::post('/posts','\App\Http\Controllers\PostController@store');
//文章详情页
Route::get('/posts/{post}','\App\Http\Controllers\PostController@show');

//编辑文章
Route::get('/posts/{id}/edit','\App\Http\Controllers\PostController@edit');
Route::put('/posts/{id}','\App\Http\Controllers\PostController@update');
//删除文章
Route::get('/posts/{id}/delete','\App\Http\Controllers\PostController@delete');
//图片上传
Route::post('/posts/image/upload','\App\Http\Controllers\PostController@imageUpload');
//提交评论
Route::post('/posts/{post}/comment','\App\Http\Controllers\PostController@comment');

Route::get('/posts/{id}/zan','\App\Http\Controllers\PostController@zan');
Route::get('/posts/{id}/unzan','\App\Http\Controllers\PostController@unzan');
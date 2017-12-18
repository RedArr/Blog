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
//注册模块
Route::get('/register','\App\Http\Controllers\RegisterController@index');
//注册行为
Route::post('/register','\App\Http\Controllers\RegisterController@register');
//登陆界面
Route::get('/login','\App\Http\Controllers\LoginController@index');
//登陆行为
Route::post('/login','\App\Http\Controllers\LoginController@login');
//登出行为
Route::get('/logout','\App\Http\Controllers\LoginController@logout');
//个人设置页面
Route::get('/user/setting','\App\Http\Controllers\UserController@setting');
//个人设置操作
Route::get('/user/me/setting','\App\Http\Controllers\UserController@settingStore');

//文章列表页
Route::get('/posts','\App\Http\Controllers\PostController@index');
//创建页面
Route::get('/posts/create','\App\Http\Controllers\PostController@create');
//文章详情
Route::get('/posts/{post}','\App\Http\Controllers\PostController@show');
//创建逻辑
Route::post('/posts','\App\Http\Controllers\PostController@store');
//编辑文章
Route::get('/posts/{post}/edit','\App\Http\Controllers\PostController@edit');
//编辑逻辑
Route::put('/posts/{post}','\App\Http\Controllers\PostController@update');
//删除逻辑
Route::get('/posts/{post}/delete','\App\Http\Controllers\PostController@delete');
//图片上传
Route::post('/posts/image/upload','\App\Http\Controllers\PostController@upload');
//测试
Route::get('/test','\App\Http\Controllers\PostController@test');

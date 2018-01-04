<?php
Route::group(['prefix'=>'admin'],function (){
    //登陆
    Route::get('/login','\App\Admin\Controllers\LoginController@index');
    //登陆逻辑
    Route::post('/login','\App\Admin\Controllers\LoginController@login');
    //登出
    Route::get('/logout','\App\Admin\Controllers\LoginController@logout');
    Route::group(['middleware'=>'auth:admin'],function (){
        Route::get('/home','\App\Admin\Controllers\HomeController@home');
        //管理人员模块
        Route::get('/users','\App\Admin\Controllers\UserController@index');
        Route::get('/users/create','\App\Admin\Controllers\UserController@create');
        Route::post('/users/store','\App\Admin\Controllers\UserController@store');
        Route::get('/users/{user}/delete','\App\Admin\Controllers\UserController@delete');
        Route::get('/test','\App\Admin\Controllers\UserController@test');
    });
    //首页

});
?>
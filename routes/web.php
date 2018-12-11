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
//后台不需要登录拦截
Route::group (['prefix'=>'admin','namespace'=>'Admin','as'=>'admin.'],function (){
    //加载登录页面
    Route::get ('/login','LoginController@index')->name ('login');
    Route::post ('/login','LoginController@login')->name ('login');
});

//后台需要登录拦截  需要创建中间件判断用户是否登录 然后在在去注册Kernel
Route::group (['middleware'=>['admin.auth'],'prefix'=>'admin','namespace'=>'Admin', 'as'=>'admin.'],function(){
    //后台欢迎页面
    Route::get('/','IndexController@index')->name ('index');
    //退出
    Route::get ('/logout','LoginController@logout')->name ('logout');
});

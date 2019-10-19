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

Route::get('/',function () {
   return phpinfo();
});

Route::namespace('Admin')->prefix('admin')->group(function () {
    Route::get('login','LoginController@index')->name('login');
    Route::post('login','LoginController@login')->name('post.login');
});

Route::namespace('Admin')->prefix('admin')->group(function () {
   Route::get('/','AdminController@index')->name('dashboard');
   Route::post('logout','\AdminController@logout')->name('logout');

   // 文章
   Route::prefix('article')->group(function () {
       Route::get('/','ArticleController@index')->name('article.index');
       Route::get('create', 'ArticleController@create')->name('article.create');
       Route::post('store', 'ArticleController@store')->name('article.store');
       Route::get('edit/{article}','ArticleController@edit')->name('article.edit');
       Route::post('update/{article}','ArticleController@update')->name('article.update');
       Route::post('delete/{article}','ArticleController@delete')->name('article.delete');
   });

   // 分类
   Route::prefix('category')->group(function () {
       Route::get('/','CategoryController@index')->name('category.index');
       Route::get('create','CategoryController@create')->name('category.create');
       Route::post('store','CategoryController@store')->name('category.store');
       Route::get('edit/{category}','CategoryController@edit')->name('category.edit');
       Route::post('update/{category}','CategoryController@update')->name('category.update');
       Route::post('delete/{category}','CategoryController@delete')->name('category.delete');
   });

   // 标签
   Route::prefix('tag')->group(function () {
       Route::get('/','TagController@index')->name('tag.index');
       Route::get('create','TagController@create')->name('tag.create');
       Route::post('store','TagController@store')->name('tag.store');
       Route::post('delete/{tag}','TagController@delete')->name('tag.delete');
       Route::get('edit/{tag}','TagController@edit')->name('tag.edit');
       Route::post('update/{tag}','TagController@update')->name('tag.update');
   });
});

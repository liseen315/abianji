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

Route::namespace('Admin')->prefix('admin')->middleware('admin.auth')->group(function () {
   Route::get('/','AdminController@index')->name('dashboard');
   Route::post('logout','\AdminController@logout')->name('logout');
});

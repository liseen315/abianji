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

Route::namespace('Admin')->prefix('admin')->group(function () {
    Route::get('login','LoginController@index')->name('login');
    Route::post('login','LoginController@login')->name('post.login');
});

Route::namespace('Admin')->prefix('admin')->middleware('admin.user')->group(function () {
   Route::get('/',function () {
      return 'dashboard';
   })->name('dashboard');
});

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

// Route::get('/info', function () {
//     return phpinfo();
// });

// Route::get('mailable',function () {
//     $comment = App\Models\Comment::find(5);

//     return new App\Mail\SocialComment($comment);
// });

Route::namespace('Home')->group(function () {
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('article/{article}/{slug?}', 'HomeController@article')->name('home.article');
    Route::get('archives', 'HomeController@archives')->name('home.archives');
    Route::get('archives/{year}', 'HomeController@archiveByYear')->name('home.archives.year');
    Route::get('tags/{tag}/{slug?}', 'HomeController@tags')->name('home.tags');
    Route::get('category/{category}/{slug?}', 'HomeController@category')->name('home.category');
    Route::get('about', 'HomeController@about')->name('home.about');
    Route::post('preview', 'HomeController@previewMarkdown')->name('home.preview');
    Route::post('postcomment', 'HomeController@postcomment')->name('home.postcomment')->middleware('socialite.auth');
    Route::get('post/{article}/comments', 'HomeController@comments')->name('home.article.comments');
    Route::get('comments/{comment}', 'HomeController@currentComment')->name('home.currentComments');
    Route::post('comments/update/{comment}', 'HomeController@updateComment')->name('home.comment.update')->middleware('socialite.auth');;
});

Route::namespace('Auth')->prefix('socialite')->group(function () {
    Route::get('login/{service}', 'SocialiteController@redirectToProvider')->name('socialite.redirect');
    Route::get('callback/{service}', 'SocialiteController@handleProviderCallback')->name('socialite.callback');
    Route::get('logout', 'SocialiteController@logout')->name('socialite.logout');
});

Route::namespace('Admin')->prefix('admin')->group(function () {
    Route::get('login', 'LoginController@index')->name('login');
    Route::post('login', 'LoginController@login')->name('post.login');
});

Route::namespace('Admin')->prefix('admin')->middleware('admin.auth')->group(function () {
    Route::get('/', 'AdminController@index')->name('dashboard');
    Route::post('logout', 'AdminController@logout')->name('logout');

    // 文章
    Route::prefix('article')->group(function () {
        Route::get('/', 'ArticleController@index')->name('article.index');
        Route::get('create', 'ArticleController@create')->name('article.create');
        Route::post('store', 'ArticleController@store')->name('article.store');
        Route::get('edit/{article}', 'ArticleController@edit')->name('article.edit');
        Route::post('update/{article}', 'ArticleController@update')->name('article.update');
        Route::post('delete/{article}', 'ArticleController@delete')->name('article.delete');
        Route::post('upload', 'ArticleController@upload')->name('article.upload');
    });

    // 分类
    Route::prefix('category')->group(function () {
        Route::get('/', 'CategoryController@index')->name('category.index');
        Route::get('create', 'CategoryController@create')->name('category.create');
        Route::post('store', 'CategoryController@store')->name('category.store');
        Route::get('edit/{category}', 'CategoryController@edit')->name('category.edit');
        Route::post('update/{category}', 'CategoryController@update')->name('category.update');
        Route::post('delete/{category}', 'CategoryController@delete')->name('category.delete');
    });

    // 标签
    Route::prefix('tag')->group(function () {
        Route::get('/', 'TagController@index')->name('tag.index');
        Route::get('create', 'TagController@create')->name('tag.create');
        Route::post('store', 'TagController@store')->name('tag.store');
        Route::post('delete/{tag}', 'TagController@delete')->name('tag.delete');
        Route::get('edit/{tag}', 'TagController@edit')->name('tag.edit');
        Route::post('update/{tag}', 'TagController@update')->name('tag.update');
    });

    // 基础配置
    Route::prefix('config')->group(function () {
        Route::get('edit', 'ConfigController@edit')->name('config.edit');
        Route::post('update', 'ConfigController@update')->name('config.update');
        Route::get('create', 'ConfigController@create')->name('config.create');
        Route::post('store', 'ConfigController@store')->name('config.store');
    });

    Route::prefix('about')->group(function () {
        Route::get('/', 'AboutController@index')->name('about.index');
        Route::post('store', 'AboutController@store')->name('about.store');
        Route::post('update', 'AboutController@update')->name('about.update');
    });

    Route::prefix('comment')->group(function () {
        Route::get('/', 'CommentController@index')->name('comment.index');
        Route::get('/users','CommentController@users')->name('comment.users');
        Route::post('delete/{comment}', 'CommentController@delete')->name('comment.delete');
    });
});

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\SocialiteUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AdminController extends Controller
{

    public function index()
    {
        $articles = Article::count();
        $socialUsers = SocialiteUser::count();
        $comments = Comment::count();
        $category = Category::where('parent_id', '!=', 0)->count();

        $version = [
            'system' => PHP_OS,
            'webServer' => $_SERVER['SERVER_SOFTWARE'] ?? '',
            'php' => PHP_VERSION,
            'mysql' => DB::connection()->getPdo()->query('SELECT VERSION();')->fetchColumn(),
        ];

        return view('admin.dashboard.index', compact('articles', 'socialUsers', 'comments', 'category', 'version'));
    }

    /**
     * 登出
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        auth('admin')->logout();
        return redirect()->route('login');
    }
}

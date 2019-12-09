<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Comment;
use App\Models\SocialiteUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function index()
    {
        $articles = Article::count();
        $socialUsers = SocialiteUser::count();
        $comments = Comment::count();

        return view('admin.dashboard.index', compact('articles', 'socialUsers', 'comments'));
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

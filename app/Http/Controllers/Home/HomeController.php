<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('is_top', 'desc')->orderBy('created_at', 'desc')->paginate(15);
        return view('app.index', compact('articles'));
    }

    public function article(Article $article)
    {

        $prev = Article::where('id', '<', $article->id)->limit(1)->first();
        $next = Article::where('id', '>', $article->id)->limit(1)->first();

        return view('app.article', compact('article', 'prev', 'next'));
    }
}

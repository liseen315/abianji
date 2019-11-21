<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * 首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $articles = Article::orderBy('is_top', 'desc')->orderBy('created_at', 'desc')->paginate(3);
        return view('app.index', compact('articles'));
    }

    /**
     * 文章详情
     * @param Article $article
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function article(Article $article)
    {
        $prev = Article::where('id', '<', $article->id)->limit(1)->first();
        $next = Article::where('id', '>', $article->id)->limit(1)->first();

        return view('app.article', compact('article', 'prev', 'next'));
    }

    /**
     * 归档
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function archives()
    {
        $articles = Article::orderBy('created_at', 'desc')->paginate(20);
        $iteration = $articles->groupBy(function ($val) {
            return Carbon::parse($val->created_at)->format('Y');
        });

        return view('app.archives', compact('iteration', 'articles'));
    }

    public function archiveByYear($year)
    {
        $articles = Article::whereYear('created_at', $year)->orderBy('created_at', 'desc')->paginate(20);
        $iteration[$year] = $articles;
        return view('app.archives', compact('iteration', 'articles'));
    }
}

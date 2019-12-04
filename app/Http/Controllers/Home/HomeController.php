<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Cache;
use Markdown;

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
    public function article(Article $article, Request $request)
    {
        // 一天内根据ip以及文章id作为key增加点击量
        $viewsKey = 'click' . $request->ip() . ':' . $article->id;
        if (!Cache::has($viewsKey)) {
            $expiresAt = now()->addMinutes(1440);
            cache([$viewsKey => ''], $expiresAt);
            $article->increment('views');
        }
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

    public function tags(Tag $tag)
    {
        $articles = Article::whereIn('id', $tag->article_list)->orderBy('created_at', 'desc')->paginate(20);
        $iteration = $articles->groupBy(function ($val) {
            return Carbon::parse($val->created_at)->format('Y');
        });

        return view('app.tags', compact('iteration', 'articles', 'tag'));
    }

    public function category(Category $category)
    {
        $articles = Article::whereIn('id', $category->article_list)->orderBy('created_at', 'desc')->paginate(20);
        $iteration = $articles->groupBy(function ($val) {
            return Carbon::parse($val->created_at)->format('Y');
        });
        return view('app.category', compact('iteration', 'articles', 'category'));
    }

    public function about()
    {

        $about = About::findOrFail(1);

        return view('app.about', compact('about'));
    }

    /**
     * 预览markdown
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function previewMarkdown(Request $request)
    {
        $htmlContent = Markdown::convertToHtml($request->input('markdown'));
        return response()->json(['status' => 0, 'body' => ['content' => $htmlContent], 'msg' => 'success']);
    }

    public function comment(Request $request)
    {
        $socialiteUser = auth('socialite')->user();
        $socialiteUserId = $socialiteUser->id;
        $article_id = $request->input('article_id');
        $parent_id = $request->input('parent_id');
        $content = $request->input('content');
        $markdown = Markdown::convertToHtml($content);

        $comment = Comment::create([
            'parent_id' => $parent_id,
            'socialite_user_id' => $socialiteUserId,
            'article_id' => $article_id,
            'markdown' => $markdown,
            'content' => $content
        ]);

        return response()->json(['status' => 0, 'body' => ['markdown' => $markdown, 'isAdmin' => false, 'user' => ['id' => $socialiteUserId, 'avatar' => $socialiteUser->avatar, 'name' => $socialiteUser->name], 'time' => $comment->created_at], 'msg' => 'success']);
    }
}

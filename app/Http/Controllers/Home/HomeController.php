<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmail;
use App\Mail\SocialComment;
use App\Models\About;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\SocialiteUser;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Cache;
use Markdown;
use Mail;

class HomeController extends Controller
{
    /**
     * 首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $articles = Article::orderBy('is_top', 'desc')->orderBy('created_at', 'desc')->paginate(10);
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
        $commentsNum = Comment::where('article_id', $article->id)->count();

        return view('app.article', compact('article', 'prev', 'next', 'commentsNum'));
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
        return response()->json(['status' => 0, 'body' => ['content' => $htmlContent], 'msg' => config('statuscode.0')]);
    }

    /**
     * 发布评论
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postComment(Request $request)
    {
        // 当前登录留言系统的社交账户
        $socialiteUser = auth('socialite')->user();
        $socialiteUserId = $socialiteUser->openid;

        $article_id = $request->input('article_id');
        $markdown = $request->input('markdown');
        $replyId = $request->input('replyId');

        $content = Markdown::convertToHtml($markdown);

        $comment = Comment::create([
            'socialite_user_id' => $socialiteUserId,
            'article_id' => $article_id,
            'markdown' => $markdown,
            'content' => $content
        ]);

        if ($comment) {

            // 如果有人给文章留言了给Blog作者发送邮件
            $admin = User::where('email', env('ADMIN_NAME'))->first();

            // 如果有人给文章留言了给博主发邮件,自己留言不算
            if ($socialiteUser->email != $admin->email) {
                $details = [
                    'email' => $admin->email,
                    'name' => $admin->name,
                    'comment' => $comment
                ];
                SendEmail::dispatch($details)->delay(Carbon::now()->addSeconds(10))->onConnection('redis')->onQueue('email');
            }

            $replyUser = SocialiteUser::where('openid', $replyId)->first();

            if (!is_null($replyUser)) {
                $details = [
                    'email' => $replyUser->email,
                    'name' => $replyUser->nick_name,
                    'comment' => $comment
                ];
                SendEmail::dispatch($details)->delay(Carbon::now()->addSeconds(10))->onConnection('redis')->onQueue('email');
            }

            return response()->json([
                'status' => 0,
                'body' => [
                    'id' => $comment->id,
                    'markdown' => $markdown,
                    'content' => $content,
                    'isAdmin' => false,
                    'user' => ['id' => $socialiteUserId, 'avatar' => $socialiteUser->avatar, 'nick_name' => $socialiteUser->nick_name],
                    'time' => $comment->created_at],
                'msg' => config('statuscode.0')]);
        } else {
            return response()->json(['status' => 4001, 'body' => [], 'msg' => config('statuscode.4001')]);
        }

    }

    /**
     * 获取评论分页列表
     * @param Request $request
     * @param Article $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function comments(Request $request, Article $article)
    {

        $comments = Comment::where('article_id', $article->id)->orderBy('created_at', 'desc')->paginate(10, ['*'], 'page', $request->get('current_page'));
        $converItem = [];

        foreach ($comments->items() as $item) {
            $socialiteUser = SocialiteUser::where('openid', $item->socialite_user_id)->first();

            $converItem[] = [
                'id' => $item->id,
                'content' => $item->content,
                'isAdmin' => false,
                'user' => ['id' => $item->socialite_user_id, 'avatar' => $socialiteUser->avatar, 'nick_name' => $socialiteUser->nick_name],
                'time' => $item->created_at
            ];

        }
        $response = [
            'pagination' => [
                'total' => $comments->total(),
                'currentPage' => $comments->currentPage(),
                'perPage' => $comments->perPage(),
                'lastPage' => $comments->lastPage(),
            ],
            'list' => $converItem
        ];
        return response()->json(['status' => 0, 'body' => $response, 'msg' => 'success']);
    }

    /**
     * 获取当前评论
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function currentComment(Comment $comment)
    {
        return response()->json(['status' => 0, 'body' => $comment, 'msg' => 'success']);
    }

    /**
     * 更新评论
     * @param Comment $comment
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateComment(Comment $comment, Request $request)
    {
        $markdown = $request->input('markdown');
        $content = Markdown::convertToHtml($markdown);

        $comment->update(['markdown' => $markdown, 'content' => $content]);

        return response()->json(['status' => 0, 'body' => ['id' => $comment->id, 'content' => $content], 'msg' => 'success']);
    }
}

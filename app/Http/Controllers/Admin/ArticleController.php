<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Article\ArticleStoreRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Cloudder;
use Str;

class ArticleController extends Controller
{

    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->simplePaginate(15);

        return view('admin.article.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::where('parent_id', '!=', 0)->get();
        $tags = Tag::all();

        return view('admin.article.create', compact('categories', 'tags'));
    }

    public function store(ArticleStoreRequest $request)
    {
        $articleData = $request->except('_token');

        if (is_null($request->input('cover'))) {
            $articleData['cover'] = '';
        }

        // $articleData['slug'] = Str::slug($articleData['title'],'-'); 框架自带的slug还不支持中文😭
        $article = Article::create($articleData);

        // 给文章插入Tag
        if (!is_null($request->input('tag_list'))) {
            $this->syncTags($article, $request->input('tag_list'));
        }

        return redirect()->route('article.index')->with('success', '创建文章成功');
    }

    public function edit(Article $article)
    {
        $categories = Category::where('parent_id', '!=', 0)->get();
        $tags = Tag::all();
        $checkTags = $article->tag_list;

        return view('admin.article.edit', compact('article', 'categories', 'tags', 'checkTags'));
    }

    public function update(Article $article, ArticleStoreRequest $request)
    {
        $article->update($request->all());

        $this->syncTags($article, $request->input('tag_list'));

        return redirect()->route('article.index')->with('success', '更新文章成功');
    }

    public function delete(Article $article)
    {
        //删除关联表内的记录
        foreach ($article->tags as $tag) {
            $tag->pivot->delete();
        }

        $article->delete();

        return redirect()->route('article.index')->with('success', '删除文章成功');
    }

    /**
     * 上传层面图到cdn
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'cover_img' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($validation->passes()) {
            $image = $request->file('cover_img');
            $upload = Cloudder::upload($image, null, ['folder' => env('CLOUDINARY_FLODER_NAME')]);
            if ($upload) {
                $image_url = $upload->getResult()['url'];
                return response()->json(['status' => 0, 'body' => ['imgURL' => $image_url], 'msg' => '上传图片成功']);
            }
        } else {
            return response()->json(['status' => 3001, 'msg' => config('errCode')[3001]]);
        }
    }

    private function syncTags(Article $article, array $tags)
    {

        $allTagIds = array();
        foreach ($tags as $tagId) {
            if (substr($tagId, 0, 4) == 'new:') {
                $newTag = Tag::create(['name' => substr($tagId, 4)]);
                $allTagIds[] = $newTag->id;
                continue;
            }
            $allTagIds[] = $tagId;
        }

        $article->tags()->sync($allTagIds);
    }


}

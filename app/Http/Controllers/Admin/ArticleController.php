<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Article\ArticleStoreRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Controllers\Controller;

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

        if ($request->hasFile('cover')) {
            $path = $request->cover->store('images');
            $articleData['cover'] = $path;
        }

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
        $article->delete();

        return redirect()->route('article.index')->with('success', '删除文章成功');
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

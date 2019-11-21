<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Tag\TagStoreRequest;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Slug;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();

        return view('admin.tag.index', compact('tags', $tags));
    }

    public function create()
    {
        return view('admin.tag.create');
    }

    /**
     * 存储Tag
     * @param TagStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TagStoreRequest $request)
    {
        $tagData['name'] = $request->input('name');
        $tagData['slug'] = Slug::translate($request->input('name'));
        Tag::create($tagData);

        return redirect()->route('tag.index')->with('success', '创建标签成功');
    }

    /**
     * 编辑Tag
     * @param Tag $tag
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Tag $tag)
    {
        return view('admin.tag.edit', compact('tag', $tag));
    }

    /**
     * 更新Tag
     * @param Tag $tag
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Tag $tag, Request $request)
    {
        $tagData['name'] = $request->input('name');
        $tagData['slug'] = Slug::translate($request->input('name'));

        $tag->update($tagData);
        return redirect()->route('tag.index')->with('success', '更新标签成功');
    }

    /**
     * 删除Tag 使用的Ajax
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Tag $tag)
    {
        // 删除关联表内的记录
        foreach ($tag->articles as $article) {
            $article->pivot->delete();
        }

        $tag->delete();

        return redirect()->route('tag.index')->with('success', '删除标签成功');
    }
}

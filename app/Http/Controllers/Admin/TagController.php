<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Tag\TagStoreRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $data = $request->except('_token');

        Tag::create($data);
        return redirect()->route('tag.index')->with('success', '创建标签成功');
    }

    /**
     * 编辑Tag
     * @param Tag $tag
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Tag $tag)
    {
        return view('admin.tag.edit',compact('tag',$tag));
    }

    /**
     * 更新Tag
     * @param Tag $tag
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Tag $tag, Request $request) {
        $tag->update(['name' => $request->input('name')]);
        return redirect()->route('tag.index')->with('success','更新标签成功');
    }

    /**
     * 删除Tag 使用的Ajax
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        if (empty($request->input('id'))) {
            return response()->json(['status' => 2001, 'msg' => config('errorcode.code')[2001]]);
        }

        $result = Tag::where('id', '=', $request->input('id'))->delete();

        if (!$result) {
            return response()->json(['status' => 2002, 'msg' => config('errorcode')[2002]]);
        }

        return response()->json(['status' => 0, 'msg' => '删除成功']);
    }
}

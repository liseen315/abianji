<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function index() {
        $tags = Tag::all();
        return view('admin.tag.index',compact('tags',$tags));
    }

    public function create() {
        return view('admin.tag.create');
    }

    public function store(Request $request) {
        $this->validate($request,[
            'name' => 'required|min:2|max:10|string'
        ]);
        $data = $request->except('_token');

        Tag::create($data);
        return redirect()->route('tag.index')->with('success','创建标签成功');
    }
}

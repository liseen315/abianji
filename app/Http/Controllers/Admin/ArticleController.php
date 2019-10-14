<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    //

    public function index() {
        $articles = Article::all();
        return view('admin.article.index',compact('articles'));
    }

    public function create() {
        $categories = Category::where('parent_id','!=',0)->get();
        $tags = Tag::all();
        return view('admin.article.create', compact('categories','tags'));
    }

    public function store(Request $request) {
        $this->validate($request,[
            'category_id'=>'required',
            'cover' => 'file|max:1024',
        ]);

        $articleData = $request->except('_token');

        if ($request->hasFile('cover')) {
            $path = $request->cover->store('images');
            $articleData['cover'] = $path;
        }

        $article = Article::create($articleData);

        return redirect()->route('article.index')->with('success','创建文章成功');
    }

    public function edit($id) {

    }

    public function update($id) {

    }

    public function delete() {

    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::with('children')->where('parent_id',0)->get();
        return view('admin.category.index',compact('categories',$categories));
    }

    public function create() {
        $categories = Category::all();
        return view('admin.category.create',compact('categories',$categories));
    }

    public function store(Request $request) {
        $this->validate($request,[
            'name' => 'required|min:2|max:10|string'
        ]);
        $data = $request->except('_token');

        Category::create($data);
        return redirect()->route('category.index')->with('success','创建分类成功');
    }

    public function edit() {

    }

    public function update() {

    }

    public function delete() {

    }
}

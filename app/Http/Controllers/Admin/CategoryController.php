<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index() {
        return view('admin.category.index');
    }

    public function create() {
        $categories = Category::all();
        return view('admin.category.create',compact('categories',$categories));
    }

    public function store(Request $request) {
        $this->validate($request,[
            'name' => 'required|min:3|max:255|string'
        ]);
        $data = $request->except('_token');

        Category::create($data);
        return redirect()->route('category.index')->with('status','创建分类成功');
    }

    public function edit() {

    }

    public function update() {

    }

    public function delete() {

    }
}

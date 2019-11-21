<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Category\CategoryStoreRequest;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Slug;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('children')->where('parent_id', 0)->get();

        return view('admin.category.index', compact('categories', $categories));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.category.create', compact('categories', $categories));
    }

    /**
     * 存储分类
     * @param CategoryStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryStoreRequest $request)
    {
        $data = $request->except('_token');
        $data['slug'] = Slug::translate($request->input('name'));
        Category::create($data);

        return redirect()->route('category.index')->with('success', '创建分类成功');
    }

    /**
     * 编辑分类
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category', $category));
    }

    /**
     * 更新分类
     * @param Category $category
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Category $category, Request $request)
    {
        $data['name'] = $request->input('name');
        $data['slug'] = Slug::translate($request->input('name'));

        $category->update($data);

        return redirect()->route('category.index')->with('success', '更新分类成功');
    }

    /**
     * 删除分类
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(Category $category)
    {
        // 删除子分类
        if ($category->children) {

            foreach ($category->children as $child) {
                if ($child->articles) {
                    foreach ($child->articles as $article) {
                        $article->category_id = 0;
                        $article->save();
                    }
                }
            }

            $category->children()->delete();
        }

        if ($category->articles) {
            foreach ($category->articles as $article) {
                $article->category_id = 0;
                $article->save();
            }
        }

        $category->delete();

        return redirect()->route('category.index')->with('success', '删除分类成功');

    }
}

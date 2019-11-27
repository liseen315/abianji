<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use Markdown;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::find(1);

        return view('admin.about.index', compact('about'));
    }

    public function store(Request $request)
    {
        $aboutData = $request->except('_token');
        $aboutData['content'] = Markdown::convertToHtml($aboutData['markdown']);
        About::create($aboutData);
        return redirect()->back()->with('success', '保存成功');
    }

    public function update(Request $request)
    {
        $aboutData = $request->except('_token');
        $aboutData['content'] = Markdown::convertToHtml($aboutData['markdown']);

        $about = About::find(1);
        $about->update($aboutData);

        return redirect()->back()->with('success', '更新成功');
    }


}

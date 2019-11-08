<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('is_top', 'desc')->orderBy('created_at', 'desc')->paginate(15);

        return view('app.index', compact('articles'));
    }
}

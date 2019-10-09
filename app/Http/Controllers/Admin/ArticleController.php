<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    //

    public function index() {
        return view('admin.article.index');
    }

    public function create() {
        return view('admin.article.create');
    }

    public function store() {

    }

    public function edit($id) {

    }

    public function update($id) {

    }

    public function delete() {

    }
}

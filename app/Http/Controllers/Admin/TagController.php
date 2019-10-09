<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function index() {
        return view('admin.tag.index');
    }

    public function create() {
        return view('admin.tag.create');
    }
}

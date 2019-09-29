<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function index() {
        return 'This is admin dashboard';
    }

    /**
     * 登出
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout() {
        auth()->logout();
        return redirect()->route('login');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    function index(){
        return view('login');
    }

    function login() {
        return 'login';
    }
}

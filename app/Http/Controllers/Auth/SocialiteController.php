<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use URL;

class SocialiteController extends Controller
{
    public function redirectToProvider(Request $request, $services)
    {
        $preURL = [
            'targetUrl' => URL::previous(),
        ];
        session($preURL);
        return Socialite::driver($services)->redirect();
    }

    public function handleProviderCallback(Request $request, $services)
    {
        $user = Socialite::driver($services)->user();
        // 定位到留言板块
    }

    public function logout()
    {

    }
}

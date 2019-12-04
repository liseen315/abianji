<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SocialiteUser;
use Illuminate\Http\Request;
use Socialite;
use URL;
use Markdown;

class SocialiteController extends Controller
{
    public function redirectToProvider(Request $request, $services)
    {
        $preURL = [
            'preURL' => URL::previous(),
        ];
        session($preURL);
        return Socialite::driver($services)->redirect();
    }

    public function handleProviderCallback(Request $request, $services)
    {
        $socialData = Socialite::driver($services)->user();

        $user = SocialiteUser::where('openid', $socialData->id)->first();

        if ($user) {
            // 更新
            $user->update([
                'name' => $socialData->name,
                'access_token' => $socialData->token,
                'last_login_ip' => $request->getClientIp(),
                'login_times' => $user->login_times + 1,
            ]);
        } else {
            $user = SocialiteUser::create([
                'name' => $socialData->name,
                'nick_name' => $socialData->nickname,
                'avatar' => $socialData->avatar,
                'email' => $socialData->email,
                'openid' => $socialData->id,
                'access_token' => $socialData->token,
                'login_ip' => $request->getClientIp(),
                'login_times' => 1,
            ]);
        }

        // 认证
        auth('socialite')->login($user);

        return redirect(session('preURL', '/'));
    }

    public function previewMarkdown(Request $request)
    {
        $htmlContent = Markdown::convertToHtml($request->input('markdown'));
        return response()->json(['status' => 0, 'body' => ['content' => $htmlContent], 'msg' => 'success']);
    }

    public function logout()
    {
        auth('socialite')->logout();
        return redirect()->back();
    }
}

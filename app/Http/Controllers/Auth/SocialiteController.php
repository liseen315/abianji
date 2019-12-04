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
    /**
     * 对接社交驱动
     * @param Request $request
     * @param $services 预留拓展用于支持多个社交媒体,当前只支持github
     * @return mixed
     */
    public function redirectToProvider(Request $request, $services)
    {
        $preURL = [
            'preURL' => URL::previous(),
        ];
        session($preURL);
        return Socialite::driver($services)->redirect();
    }

    /**
     * 驱动返回数据用于在系统内验证登录
     * @param Request $request
     * @param $services
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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

    /**
     * 社交登出
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        auth('socialite')->logout();
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    use  AuthenticatesUsers;

    /**
     * 登录视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // 如果用户被认证过,则直接跳转到dashboard
        if (auth()->user()) {
            return redirect()->route('dashboard');
        }

        return view('login');
    }

    /**
     * 登录post请求
     * @param Request $request
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response|void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        // 验证登录,默认email
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->credentials($request);


        if (auth()->attempt($credentials, $request->has('remember'))) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);

    }

    /**
     * 登录成功后的重定向
     * @return string
     */
    public function redirectTo()
    {
        return route('dashboard');
    }
}

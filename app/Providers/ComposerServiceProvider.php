<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * 给后台导航登出绑定全局管理员
         */
        view()->composer(['layouts.admin'],function ($view) {
           $user = User::find(1);
           $view->with(compact('user'));
        });

        /**
         * 给前端Layout绑定全局变量
         */

        view()->composer(['layouts.frontend'],function ($view) {
            $user = User::find(1);
            $view->with(compact('user'));
        });
    }
}

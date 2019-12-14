<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\User;
use Carbon\Carbon;
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
        view()->composer(['layouts.admin'], function ($view) {
            $user = User::find(1);
            // 给后台管理面板输出昨天->当前时间范围内的所有留言
            $newComments = Comment::whereBetween('created_at', [Carbon::yesterday(), Carbon::now()])->get();
            $view->with(compact('user', 'newComments'));
        });

        /**
         * 给前端Layout绑定全局变量
         */

        view()->composer(['layouts.frontend'], function ($view) {
            $user = User::find(1);
            $view->with(compact('user'));
        });
    }
}

<?php

namespace App\Providers;

use App\Services\SlugServices;
use Illuminate\Support\ServiceProvider;

class SlugServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Slug',function ($app) {
            return new SlugServices($app['config']['slug']);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function provides()
    {
       return ['Slug'];
    }
}

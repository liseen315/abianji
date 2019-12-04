<?php

namespace App\Providers;
use Blade;
use Carbon\Carbon;
use Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(\Clockwork\Support\Laravel\ClockworkServiceProvider::class);
        }
    }


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 为模板的sidebar active状态定义指令
        Blade::directive('sideIsActive',function ($expression) {
            list($targetName, $activeStr) = explode(',', $expression);

            return "<?php if (strpos(Route::currentRouteName(),{$targetName}) === 0) { echo {$activeStr}; } else { echo '' ;}  ?>";
        });

        // 设置时区

        Carbon::setLocale('zh');
    }
}

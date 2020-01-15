<?php


namespace App\Services;

use App\Models\Article;
use App\Models\Config;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class RedisServices
{
    private $expiresAt = 0;

    public function __construct()
    {
        $this->expiresAt = Carbon::now()->addMinutes(1440);
    }

    /**
     * 更新配置缓存
     * @throws \Exception
     */
    public function updateConfig()
    {
        cache()->forget('configs');
        $configList = Config::select(['title', 'value'])->get()->toArray();
        $configs = [];
        foreach ($configList as $config) {
            $configs[strtolower($config['title'])] = $config['value'];
        }
        cache(['configs' => $configs], $this->expiresAt);

    }

    public function cacheArticle($value) {
        $key = hash('sha256', $value);
        $cache = Cache::remember($key, $this->expiresAt, function () use ($value) {
            return Article::where('slug',$value)->first();
        });
        return $cache;
    }
}

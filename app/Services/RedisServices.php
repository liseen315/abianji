<?php


namespace App\Services;


use App\Models\Config;
use Carbon\Carbon;

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
}

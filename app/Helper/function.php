<?php
use Illuminate\Support\Facades\Redis;

if (!function_exists('blog_config')) {
    function blog_config($key, $clear = false)
    {
        $configs = cache('configs');
        if (empty($configs) || $clear) {
            cache()->forget('configs');
            $expiresAt = now()->addMinutes(1440);
            $configList = \App\Models\Config::select(['title', 'value'])->get()->toArray();
            foreach ($configList as $config) {
                $configs[strtolower($config['title'])] = $config['value'];
            }
            cache(['configs' => $configs], $expiresAt);
        }
        return isset($configs[$key]) ? $configs[$key] : '';
    }
}

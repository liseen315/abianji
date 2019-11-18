<?php

use Illuminate\Support\Facades\Redis;
use Intervention\Image\Facades\Image;

/**
 * 从redis内获取网站基础配置
 */
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

if (!function_exists('msubstr')) {
    function msubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = true)
    {
        if (function_exists("mb_substr")) {
            $slice = mb_substr($str, $start, $length, $charset);
        } elseif (function_exists('iconv_substr')) {
            $slice = iconv_substr($str, $start, $length, $charset);
            if (false === $slice) {
                $slice = '';
            }
        } else {
            $re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
            $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
            $re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
            $re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
            preg_match_all($re[$charset], $str, $match);
            $slice = join("", array_slice($match[0], $start, $length));
        }
        return $suffix ? $slice . '...' : $slice;

    }
}

/**
 * 截取文章描述
 */

if (!function_exists("get_description")) {

    function get_description($content, $word = 200)
    {
        if (empty($content)) {
            return '...';
        }
        $description = msubstr(strip_tags($content), 0, $word);
        return $description;
    }
}

/**
 * 为系统上传的图片添加水印.暂时不做
 */
if (!function_exists('watermark')) {
    function watermark($cover)
    {

    }
}

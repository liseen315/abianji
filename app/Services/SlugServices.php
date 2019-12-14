<?php


namespace App\Services;

use GuzzleHttp\Client;
use Overtrue\Pinyin\Pinyin;
use Str;

class SlugServices
{
    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function translate($text)
    {
        if ($this->isEnglish($text)) {
            return $text;
        }
        if (empty($this->config['translate_appid']) || empty($this->config['translate_secret'])) {
            return $this->pinyin($text);
        }
        $salt = time();
        $query = $this->getArgs();
        $query['q'] = $text;
        $query['salt'] = $salt;
        $query['sign'] = $this->buildSign($text, $salt);
        $response = $this->call($query);
        if (!$response) {
            return $this->pinyin($text);
        }
        return Str::slug($response);
    }

    private function isEnglish($text)
    {
        if (preg_match("/\p{Han}+/u", $text)) {
            return false;
        }
        return true;
    }

    private function getArgs()
    {

        return [
            "from" => "zh-CHS",
            "to" => "EN",
            "appKey" => $this->config['translate_appid'],
        ];

    }

    private function buildSign($query, $salt)
    {
        $str = $this->config['translate_appid'] . $query . $salt . $this->config['translate_secret'];
        return md5($str);
    }

    private function call($query)
    {
        $http = new Client();
        $response = $http->get($this->config['api']['youdao'] . http_build_query($query));
        $re = json_decode($response->getBody(), true);
        return $re['translation'][0] ?? false;
    }

    private function returnType($data)
    {
        if ($this->config['type'] == 'baidu') {
            return $this->typeOfBaidu($data);
        } else {
            return $this->typeOfYoudao($data);
        }
    }

    private function pinyin($text)
    {
        return Str::slug(app(Pinyin::class)->permalink($text));
    }

}

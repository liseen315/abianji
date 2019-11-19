<?php

return [
    //Translate API HTTPS address
    'api' => [
        'youdao'=>  'https://openapi.youdao.com/api?'
    ],

    //App id of the translation api
    'translate_appid' => env('TRANSLATE_APPID',''),

    //secret of the translation api
    'translate_secret'   => env('TRANSLATE_SECRET',''),
];

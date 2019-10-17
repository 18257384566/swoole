<?php

$http = new swoole_http_server('0.0.0.0',8001);

$http->on('request', function($request, $response){ //time = max(redis, mysql)
    //获取redis中key的内容，然后输出到浏览器
    $redis = new Swoole\Coroutine\Redis();
    $redis->connect('127.0.0.1', 6379);
    $value = $redis->get($request->get['a']);

    $response->header('Content-Type', 'text-plain');
    $response->end($value);
});

$http->start();
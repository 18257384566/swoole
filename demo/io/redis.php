<?php

$redisClient = new Swoole\Redis;    //swoole_redis

$redisClient->connect('127.0.0.1', 6379, function($redisClient, $result){
    echo 'connect';
    var_dump($result);

    $redisClient->set('key', 'value', function($redisClient, $result){
        var_dump($result);
    });

    $redisClient->get('key', function($redisClient, $result){
        var_dump($result);
        //$redisClient->close();
    });

    $redisClient->keys('*', function($redisClient, $result){
        var_dump($result);

        $redisClient->close();
    });
});
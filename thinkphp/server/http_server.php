<?php

$http = new swoole_http_server("0.0.0.0",9111); //0.0.0.0 监听所有

$http->set([
    'enable_static_handler' => true,
    'document_root' => '/www/swoole/thinkphp/public/static',
    'worker_num' => 5,
]);


$http->on('WorkerStart', function(swoole_server $server, $worker_id){
    // 定义应用目录
    define('APP_PATH', __DIR__ . '/../application/');
    //加载框架里的文件
    require __DIR__ . '/../thinkphp/base.php';
//    require __DIR__ . '/../thinkphp/start.php';
});


$http->on('request', function($request, $response){ //$request:接受信息 $response:发送客户端
    if(isset($request->server)){
        foreach ($request->server as $k => $v){
            $_SERVER[strtoupper($k)] = $v;
        }
    }
    if(isset($request->header)){
        foreach ($request->header as $k => $v){
            $_SERVER[strtoupper($k)] = $v;
        }
    }
    if(isset($request->get)){
        foreach ($request->get as $k => $v){
            $_GET[$k] = $v;
        }
    }
    if(isset($request->post)){
        foreach ($request->post as $k => $v){
            $_POST[$k] = $v;
        }
    }

    // 2. 执行应用
    \think\App::run()->send();

    $response->cookie('name','neirong',time() + 1800);
    $response->end("lalal".json_encode($request->get));
});

$http->start();
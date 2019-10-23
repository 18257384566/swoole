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


$http->on('request', function($request, $response)use($http){ //$request:接受信息 $response:发送客户端
//    if(!empty($_GET)){
//        unset($_GET);
//    }
//    if(!empty($_POST)){
//        unset($_POST);
//    }

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
    ob_start();
    try{
        \think\App::run()->send();
    }catch (\Exception $e){
        // todo
    }
    $res = ob_get_contents(); //将缓存赋值给变量
    ob_end_clean();

    $http->reset();

    $response->cookie('name','neirong',time() + 1800);
    $response->end($res);
});

$http->start();
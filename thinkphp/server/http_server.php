<?php

$http = new swoole_http_server("0.0.0.0",9111); //0.0.0.0 监听所有

$http->set([
    'enable_static_handler' => true,
    'document_root' => '/www/swoole/thinkphp/public/static',
    'worker_num' => 4,
]);


$http->on('WorkerStart', function(swoole_server $server, $worker_id){
    // 定义应用目录
    define('APP_PATH', __DIR__ . '/../application/');
    //加载框架里的文件
    require __DIR__ . '/../thinkphp/base.php';
//    require __DIR__ . '/../thinkphp/start.php';
});

$http->on('request', function($request, $response)use($http){ //$request:接受信息 $response:发送客户端
    //跨域
    header('Access-Control-Allow-Headers:c-token,device-type,au-token,lang,Origin, Content-Type, Cookie, Accept');
    header('Access-Control-Allow-Methods:GET,POST,OPTIONS');
    header('Access-Control-Allow-Credentials:true');
    header('Access-Control-Expose-Headers:c-token,device-type,au-token,lang');
    if ($request->server['request_method'] == 'OPTIONS') {
        $response->status(http_response_code());
        $response->end();
        return;
    }

    var_dump('111');
    if(!empty($_GET)){
        unset($_GET);
    }
    if(!empty($_POST)){
        unset($_POST);
    }
    if(!empty($_FILES)){
        unset($_FILES);
    }

//var_dump($request->server);
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

    $_FILES = [];
    if(isset($request->files)){
        foreach ($request->files as $k => $v){
            $_FILES[$k] = $v;
        }
    }

    $_POST['http_server'] = $http;

    // 2. 执行应用
    ob_start();
    try{
        \think\App::run()->send();
    }catch (\Exception $e){
        // todo
    }
//    echo '-action-:'.request()->action().PHP_EOL;
    $res = ob_get_contents(); //将缓存赋值给变量
    ob_end_clean();

//    $http->close();

    $response->cookie('name','neirong',time() + 1800);
    $response->end($res);
});

$http->start();
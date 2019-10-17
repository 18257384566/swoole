<?php

$http = new swoole_http_server("0.0.0.0",9111); //0.0.0.0 监听所有

$http->set([
    'enable_static_handler' => true,
    'document_root' => '/www/swoole/thinkphp/public/static',
]);



$http->on('request', function($request, $response){ //$request:接受信息 $response:发送客户端
//        var_dump($request->get);
        $response->cookie('name','neirong',time() + 1800);
        $response->end("<h1>HTTPServer</h1><br>".json_encode($request->get));
});

$http->start();
<?php

// 创建Server对象，监听 127.0.0.1:9501端口
$serv = new Swoole\Server("127.0.0.1", 9501);

$serv->set([
    'worker_num' => 4,          //worker进程数 cpu合数的1-4倍
    'max_request' => 10000,     //处理完n此请求后结束运行
]);

//监听连接进入事件
/*
 * $fd 客户端连接的唯一标识
 * $reactor_id 线程id
 */
$serv->on('Connect', function ($serv, $fd, $reactor_id) {
    echo "Client: Connect.{$reactor_id} - {$fd}\n";
});

//监听数据接收事件
$serv->on('Receive', function ($serv, $fd, $from_id, $data) {
    $serv->send($fd, 'server:'.$data);
//    $serv->send($fd, "Server: 有什么可以帮你");
});

//监听连接关闭事件
$serv->on('Close', function ($serv, $fd) {
    echo "Client: Close.\n";
});

//启动服务器
$serv->start();

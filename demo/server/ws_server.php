<?php

$server = new swoole_websocket_server('0.0.0.0', 9112);

$server->set([
    'enable_static_handler' => true,
    'document_root' => '/www/swoole/data',
]);

//监听websocket连接打开事件
$server->on('open', function (swoole_websocket_server $server, $request) {
    echo "server: handshake success with fd:{$request->fd}\n";
});

//监听websocket消息事件
$server->on('message', function (Swoole\WebSocket\Server $server, $frame) {
    echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
    $server->push($frame->fd, "xsy-push");
});

$server->on('close', function ($ser, $fd) {
    echo "client {$fd} closed\n";
});

$server->start();
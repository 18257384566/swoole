<?php
/**
 * Created by ws优化
 * User: dlab-xsy
 * Date: 2019/8/23
 * Time: 1:49 PM
 */

class Ws{

    const HOST = '0.0.0.0';
    const PORT = 9112;

    public $ws = null;
    public function __construct()
    {
        $this->ws = new swoole_websocket_server(self::HOST,self::PORT);

        $this->ws->on("open", [$this, 'onOpen']);
        $this->ws->on("message", [$this, 'onMessage']);
        $this->ws->on("close", [$this, 'onClose']);

        $this->ws->start();
    }

    //监听ws连接事件
    public function onOpen($ws, $requst){
        var_dump($requst->fd);
    }

    //监听ws消息事件
    public function onMessage($ws, $frame){
        echo "ser-push-message:{$frame->data}\n";
        $ws->push($frame->fd, "".date('Y-m-d H:i:s'));
    }

    //关闭
    public function onClose($ws, $fd){
        echo "clientid:{$fd}\n";
    }

}

$obj = new Ws();
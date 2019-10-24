<?php
/**
 * Created by ws优化
 * User: dlab-xsy
 * Date: 2019/8/23
 * Time: 1:49 PM
 */

class Ws{

    const HOST = '0.0.0.0';
    const PORT = 9111;

    public $ws = null;
    public function __construct()
    {
        $this->ws = new swoole_websocket_server(self::HOST,self::PORT);

        $this->ws->set(array(
            'worker_num' => 2,
            'task_worker_num' => 2,
        ));

        $this->ws->on("open", [$this, 'onOpen']);
        $this->ws->on("message", [$this, 'onMessage']);
        $this->ws->on("task", [$this, 'onTask']);
        $this->ws->on("finish", [$this, 'onFinish']);
        $this->ws->on("close", [$this, 'onClose']);

        $this->ws->start();
    }

    //监听ws连接事件
    public function onOpen($ws, $requst){
        var_dump($requst->fd);
        if($requst->fd == 1){
            swoole_timer_tick(3000,function($timer_id){
                echo "3s-timerId-{$timer_id}\n";
            });
        }
    }

    //监听ws消息事件
    public function onMessage($ws, $frame){
        echo "ser-push-message:{$frame->data}\n";

        // todo 10s
        $data = [
            'task' => 1,
            'fd' => $frame->fd,
        ];
        //$ws->task($data);

        swoole_timer_after(5000,function()use($ws, $frame){
            echo "5秒后执行\n";
            $ws->push($frame->fd, "5秒后的推送");
        });
        $ws->push($frame->fd, "server-push:".date('Y-m-d H:i:s'));
    }

    public function onTask($serv, $taskId, $workerId, $data){
        var_dump($data);
        //模拟耗时场景10s
        sleep(10);
        return 'task finish';
    }

    public function onFinish($serv, $taskId, $data){
        echo "taskId:{$taskId}";
        echo "finish-task-sucess:{$data}";
    }

    //关闭
    public function onClose($ws, $fd){
        echo "clientid:{$fd}\n";
    }

}

$obj = new Ws();
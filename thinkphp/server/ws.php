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

        $this->ws->set(array(
            'enable_static_handler' => true,
            'document_root' => '/www/swoole/thinkphp/public/static',
            'worker_num' => 4,
            'task_worker_num' => 4,
        ));

        $this->ws->on("workerstart", [$this, 'onWorkerStart']);
        $this->ws->on("request", [$this, 'onRequest']);
        $this->ws->on("open", [$this, 'onOpen']);
        $this->ws->on("message", [$this, 'onMessage']);
        $this->ws->on("task", [$this, 'onTask']);
        $this->ws->on("finish", [$this, 'onFinish']);
        $this->ws->on("close", [$this, 'onClose']);

        $this->ws->start();
    }

    //
    public function onWorkerStart($server,$worker_id){
        //定义应用目录
        define('APP_PATH',__DIR__.'/../application/');
        //加载框架里面的文件
//        require __DIR__.'/../thinkphp/start.php';
        require __DIR__ . '/../thinkphp/base.php';
    }

    public function onRequest($request,$response){
        $_SERVER = [];
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

        $_GET = [];
        if(isset($request->get)){
            foreach ($request->get as $k => $v){
                $_GET[$k] = $v;
            }
        }

        $_POST = [];
        if(isset($request->post)){
            foreach ($request->post as $k => $v){
                $_POST[$k] = $v;
            }
        }

        $_POST['http_server'] = $this->ws;

        // 2. 执行应用
        ob_start();
        try{
            \think\App::run()->send();
        }catch (\Exception $e){
            // todo
        }
        $res = ob_get_contents(); //将缓存赋值给变量
        ob_end_clean();

//    $http->close();

        $response->cookie('name','neirong',time() + 1800);
        $response->end($res);
    }

    //监听ws连接事件
    public function onOpen($ws, $requst){
        var_dump($requst->fd);
    }

    //监听ws消息事件
    public function onMessage($ws, $frame){
        echo "ser-push-message:{$frame->data}\n";
        $ws->push($frame->fd, "server-push:".date('Y-m-d H:i:s'));
    }

    public function onTask($serv, $taskId, $workerId, $data){
        //分发task任务机制，让不同的任务走不同的逻辑
        $obj = new app\common\lib\task\Task;

        $method = $data['method'];
        $flag = $obj->$method($data['data']);

        return $flag;
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
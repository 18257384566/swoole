<?php
namespace app\admin\controller;

class Live
{
    public function push(){

        //入库，整理数据push到前端
        $ws = $_POST['http_server'];
        foreach($ws->connections as $fd)
        {
            $ws->send($fd, "xsy-hello-live");
        }
    }



}

<?php
namespace app\admin\controller;

class Live
{
    public function push(){
        var_dump($_GET);

        $_POST['http_server']->push(2,'xsy-hello-live');

        //入库，整理数据push到前端
//        $ws = $_POST['http_server'];
//        foreach($ws->connections as $fd)
//        {
//            $ws->send($fd, "xsy-hello-live");
//        }
    }



}

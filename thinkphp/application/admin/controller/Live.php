<?php
namespace app\admin\controller;

class Live
{
    public function push(){
        var_dump($_GET);

//        $_POST['http_server']->push(3,'xsy-hello-live');

        //入库，整理数据push到前端
        $ws = $_POST['http_server']->ports[0];
        foreach($ws->connections as $fd)
        {
//            var_dump($fd);
            $ws->push($fd, "xsy-hello-live");
        }
    }



}

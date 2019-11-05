<?php
namespace app\admin\controller;

class Live
{
    public function push(){
        var_dump($_GET);

//        $_POST['http_server']->push(3,'xsy-hello-live');

        //入库，整理数据push到前端
        foreach ($_POST['http_server']->ports[0]->connections as $fd){
            $_POST['http_server']->push($fd, 'xsy-push-live');
        }



    }



}

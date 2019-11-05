<?php
namespace app\admin\controller;

class Data
{
    public function push(){
        var_dump($_GET);

//        $_POST['http_server']->push(3,'xsy-hello-live');

        $data = [
            'user' => 'admin',
            'content' => $_GET['content'],
        ];

        //入库，整理数据push到前端
        foreach ($_POST['http_server']->connections as $fd){
            var_dump($fd);
            $_POST['http_server']->push($fd, json_encode($data));
        }



    }



}

<?php
namespace app\index\controller;

class Chart
{
    public function index()
    {
        echo 'chart';
        var_dump($_POST['http_server']);
        echo '111';
        foreach ($_POST['http_server']->ports[1]->connections as $fd){
            $_POST['http_server']->push($fd, $fd);
        }
    }


}

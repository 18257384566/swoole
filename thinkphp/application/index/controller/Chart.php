<?php
namespace app\index\controller;

class Chart
{
    public function index()
    {
        var_dump($_GET);

        foreach ($_POST['http_server']->ports[1]->connections as $fd){
            $_POST['http_server']->push($fd, $fd);
        }

    }


}

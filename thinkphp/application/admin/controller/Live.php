<?php
namespace app\admin\controller;

class Live
{
    public function push(){
        var_dump($_GET);
        echo '<br>';
        var_dump($_POST);

        //入库，整理数据push到前端
        $_POST['http_server']->push(2,'lalalalalla');
    }



}
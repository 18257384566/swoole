<?php
/**
 * Created by PhpStorm.
 * User: dlab-xsy
 * Date: 2019/8/27
 * Time: 6:26 PM
 */

$process = new swoole_process(function($pro){
    echo '111';

    $pro->exec('/usr/local/php/bin/php', [__DIR__.'/../server/http_server.php']); //exec('PHP安装目录'，[文件地址])
},true);   //false:会打印111 true：不会打印111

$pid = $process->start();
var_dump($pid);

swoole_process::wait();
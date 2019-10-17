<?php
/**
 * Created by PhpStorm.
 * User: dlab-xsy
 * Date: 2019/8/28
 * Time: 2:57 PM
 */

echo 'start:'.date('Y-m-d H:i:s');

$works = [];

$curls = [
    'https://www.baidu.com',
    'https://fanyi.baidu.com',
    'https://www.baidu.com/s?ie=UTF-8&wd=知乎',
    'https://www.baidu.com',
    'https://www.baidu.com',
    'https://www.baidu.com',
];

foreach ($curls as $k => $curl){
    $process = new swoole_process(function($pro)use($curl){
        $result = curlData($curl);
//        echo $result.PHP_EOL;   //输出到管道
        $pro->write($result.PHP_EOL);

    },true);

    $pid = $process->start();
    $works[$pid] = $process;
}

foreach ($works as $process){
    echo $process->read();  //从管道读取数据
}

function curlData($url){
    sleep(10);
    return $url.'success'.PHP_EOL;
}

echo 'end:'.date('Y-m-d H:i:s');
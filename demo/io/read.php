<?php

/**
 * swoole_async_readfile 最大读取4M
 * __DIR__ 当前目录路径
 */
swoole_async_readfile(__DIR__.'/1.txt',function($filename,$filecontent){
    echo '文件名:'.$filename.PHP_EOL;
    echo '文件内容:'.$filecontent.PHP_EOL;
});

/**
 * swoole_async_read(文件名，回调函数，文件大小，从文件第几个字符开始读取)
 */
$test = swoole_async_read(__DIR__.'/1.txt',function($filename,$filecontent){
    echo '文件名:'.$filename.PHP_EOL;
    echo '文件内容:'.$filecontent.PHP_EOL;
},8192,3);

var_dump($test);
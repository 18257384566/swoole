<?php

/**
 *FILE_APPEND 追加（不加会覆盖之前的内容）
 */
$content = date('Y-m-d H:i:s').PHP_EOL;
swoole_async_writefile(__DIR__.'/1.txt',$content,function($filename){
    echo 'success'.PHP_EOL;
},FILE_APPEND);

echo 'start';
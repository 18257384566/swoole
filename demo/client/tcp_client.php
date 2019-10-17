<?php

//连接 swoole tcp服务
$client = new swoole_client(SWOOLE_TCP);

try{
    if(!$client->connect("127.0.0.1",9501)){
        exit("连接失败. Error: {$client->errCode}\n");
    }
}catch(Exception $e){
    echo '连接失败';
    exit;
}


//php cli常量
fwrite(STDOUT,'请输入消息:');
$msg = trim(fgets(STDIN));

//发送消息给 tcp server服务器
$client->send($msg);

//接受来自server的数据
$result = $client->recv();
echo $result;


//$client = new swoole_client(SWOOLE_SOCK_TCP);
//if (!$client->connect('127.0.0.1', 9501, -1))
//{
//    exit("connect failed. Error: {$client->errCode}\n");
//}
//$client->send("hello world\n");
//echo $client->recv();
//$client->close();
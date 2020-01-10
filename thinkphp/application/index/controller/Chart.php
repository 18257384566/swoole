<?php
namespace app\index\controller;

class Chart
{
    public function index()
    {
        $game_id = $_POST['game_id'];
        $content = $_POST['content'];

        if(!isset($game_id) || !isset($content)){
            $result['status'] = -1;
            $result['message'] = '参数丢失';
            $result['data'] = [];
            return json_encode($result);
        }

        $data = [
            'user' => 'user'.rand(10000,99999),
            'game_id' => $game_id,
            'content' => $content,
        ];

        //给所有用户推送消息
        foreach ($_POST['http_server']->ports[1]->connections as $fd){
            var_dump($fd);
            $_POST['http_server']->push($fd, json_encode($data));
        }

//        $fdList = [5,4];
//        foreach ($fdList as $k => $v){
//            $_POST['http_server']->push($v,json_encode($data));
//        }

        $result['status'] = 1;
        $result['message'] = 'ok';
        $result['data'] = $data;
        return json_encode($result);

    }


}

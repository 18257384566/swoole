<?php
namespace app\admin\controller;



class Image
{
    public function index(){
        $files = request()->file('file');
        $info = $files->move('../public/static/upload');
        if($info){
            $data = [
                'image' => 'http://118.31.109.21:8811/upload/'.$info->getSaveName(),
            ];
            $result['status'] = 1;
            $result['message'] = 'ok';
            $result['data'] = $data;
            return json_encode($result);
        }
        $result['status'] = -1;
        $result['message'] = 'error';
        $result['data'] = [];
        return json_encode($result);
    }


}

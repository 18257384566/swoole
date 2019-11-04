<?php
namespace app\admin\controller;



class Image
{
    public function index(){
        $files = request()->file('file');
        $info = $files->move('../public/static/upload');
        if($info){
            $data = [
                'image' => 'http://118.31.109.21:8811/'.$info->getSaveName(),
            ];
            return \Phinx\Util\Util::show(config('code.success'),'success',$data);
        }
        return \Phinx\Util\Util::show(config('code.error'),'error');
    }


}

<?php
namespace app\admin\controller;

use Phinx\Util\Util;
 
class Image
{
    public function index(){
        $files = request()->file('file');
        $info = $files->move('../public/static/upload');
        if($info){
            $data = [
                'image' => 'http://118.31.109.21:8811/'.$info->getSaveName(),
            ];
            return Util::show(config('code.success'),'ok',$data);
        }
        return Util::show(config('code.error '),'error');
    }


}

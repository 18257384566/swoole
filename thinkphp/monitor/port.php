<?php
/**
 * Created by PhpStorm.
 * User: dlab-xsy
 * Date: 2019/11/6
 * Time: 2:52 PM
 */
class port{

    public function portListen(){
        $shell = 'netstat -anp 2>/dev/null | grep 8811 | grep LISTEN | wc -l';
        $result = shell_exec($shell);
        if($result == 0){
            //发端短信警报
            echo date('Y-m-d H:i:s').' : error';
        }else{
            echo date('Y-m-d H:i:s').' : success';
        }
    }
}

swoole_timer_tick(2000,function($timer_id){//每两秒检查一次
    $listen = new port();
    $listen->portListen();
});
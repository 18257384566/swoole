<?php
/**
 * Created by PhpStorm.
 * User: dlab-xsy
 * Date: 2019/8/27
 * Time: 2:52 PM
 */
class AsyMysql{

    public $dbSource = '';

    public function __construct()
    {
//        $this->dbSource = swoole_mysql();
        $this->dbSource = new Swoole\mysql;

        $this->dbConfig = [
            'host'        => '47.75.115.65',
            'port'        => '3306',
            'user'    => 'root',
            'password'    => '~!S@h#U$f%F^l&E*w(z)B-',
            'database'      => 'homepage',
            'charset'      => 'utf8',
        ];
    }

    public function execute($sql){
        $this->dbSource->connect($this->dbConfig, function($db, $result)use($sql){
            //判断连接是否成功
            if($result === false){
                var_dump($db->connect_error);
            }

            $db->query($sql,function($db, $dbResult){
                if($dbResult === true){
                    //增删改成功
                    echo 'true';
                }elseif($dbResult === false){
                    //增删改失败
                    echo 'true';
                }else{
                    //查询成功
                    var_dump($dbResult);
                }

                $db->close();
            });
        });
    }
}

$sql = 'select * from homepage_construction limit 1';

$mysql = new AsyMysql();
$mysql->execute($sql);
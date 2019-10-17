<?php

//创建目录
$table = new swoole_table(1024);    //小于1024则为1024， 1024,2048,4096

$table->column('no',$table::TYPE_INT,8);
$table->column('name',$table::TYPE_STRING,64);
$table->column('age',$table::TYPE_INT,3);

$table->create();


//设置并获取目录中的数据1      返回值（数组形式）
$table->set('xsy',['no'=>1, 'name'=>'邢诗韵', 'age'=> 24]);

$result = $table->get('xsy');
var_dump($result).PHP_EOL;

//设置并获取目录中的数据2    返回键值对（对象形式）
$table['xsy2'] = [
    'no' => 2,
    'name' => '邢诗韵',
    'age' => 18,
];

var_dump($table['xsy2']);


//加强
$table->incr('xsy2', 'age', 2); //incr自增  decr自减  del删除  exist是否存在
var_dump($table['xsy2']);
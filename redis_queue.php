<?php
require_once './Db.php';

//记录哈希值守护进程

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$res=$redis->lpop('goods_store');//移除并返回列表
if($res){
    $pdo=Db::instance('127.0.0.1', 'root', 'root', 'test', 'utf8');
    
    $id=mt_rand(20,30);
    //$where['id'] =['>',1];    
    $where['id'] =$id;    
    $res=$pdo->table('good')->where($where)->setDec('goods_store',1);

    var_dump($res);
}else{

    echo '秒杀失败';
}
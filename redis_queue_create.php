<?php
$redis=new Redis();
$redis->connect('127.0.0.1',6379);

//$redis->delete('goods_store');

$store=10;
for($i=0;$i<$store;$i++){
    $redis->lpush('goods_store',1);
}
var_dump($redis->lRange('goods_store',0,-1));
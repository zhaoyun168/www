<?php
$store=1000;
$redis=new Redis();
$result=$redis->connect('127.0.0.1',6379);
$redis->auth('ab123456');
$res=$redis->llen('goods_store');
echo $res;
$count=$store-$res;
for($i=0;$i<$count;$i++){
    $redis->lpush('goods_store',1);
}
echo $redis->llen('goods_store');
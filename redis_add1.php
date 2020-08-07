<?php
date_default_timezone_set('Asia/Chongqing');
include('redis_zset.php');

$dq = new DelayQueue('close_order', [
    'host' => '127.0.0.1',
    'port' => 6379,
    'auth' => '',
    'timeout' => 60,
]);

echo date('Y-m-d H:i:s');
$dq->addTask('close_order_111', time() + 30, ['order_id' => '111']);
$dq->addTask('close_order_222', time() + 60, ['order_id' => '222']);
$dq->addTask('close_order_333', time() + 90, ['order_id' => '333']);
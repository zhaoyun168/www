<?php
date_default_timezone_set('Asia/Chongqing');
include('redis_zset.php');
set_time_limit(0);
 
$dq = new DelayQueue('close_order', [
    'host' => '127.0.0.1',
    'port' => 6379,
    'auth' => '',
    'timeout' => 60,
]);
 
while (true) {
    $dq->run();
    usleep(100000);
}
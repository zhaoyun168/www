<?php
$redis = new Redis();
$redis->connect('127.0.0.1',6379);

echo date('Y-m-d H:i:s');
echo '<br>';
echo $current_index = $redis->get('current_index');

$current_index = $current_index - 1;

$redis->sAdd('task_'.$current_index, 'H001');
$redis->sAdd('task_'.$current_index, 'H002');
$redis->sAdd('task_'.$current_index, 'H003');

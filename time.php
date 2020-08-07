<?php
ini_set('date.timezone','Asia/Shanghai');
echo $start_time = microtime(true);
echo '<br>';
//echo date('Y-m-d H:i:s', $time);

$num = 0;
for ($i=0; $i < 100000; $i++) { 
	$num += $i;
}
echo$end_time = microtime(true);
echo '<br>';
echo $end_time - $start_time;


<?php
$contents = file_get_contents('order_no');

$array = explode("\r\n", $contents);

$order_no = array_count_values($array);

rsort($order_no);

print_r($order_no);
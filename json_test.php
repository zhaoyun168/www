<?php

$array = [
	'name' => '测试'
];

$array_1 = [
	'aaa' => 1,
	'bbb' => json_encode($array),
];

echo json_encode($array_1);
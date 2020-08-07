<?php
$array = [
	1,
	2,
	'a' => [
		'b',
		'c'
	]
];

$arr = var_export($array, true);

echo $arr;
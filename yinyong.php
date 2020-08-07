<?php
$a = 1;

function test(&$a){

	$a = $a + 1;
}

test($a);

echo $a;
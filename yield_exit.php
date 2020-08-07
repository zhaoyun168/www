<?php

function test(){
yield 456;
//exit;
yield 123;
}
//var_dump(test()->current());
foreach (test() as $key => $value) {
	echo $value;
	exit;
}
echo '输出即代表没有执行exit';
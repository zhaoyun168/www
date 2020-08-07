<?php

function createRange($number){
    $data = [];
    for($i=0;$i<$number;$i++){
        $data[] = time();
    }
    return $data;
}

$result = createRange(10);

foreach($result as $value){
    sleep(1);//这里停顿1秒，我们后续有用
    echo $value.'<br />';
}
<?php
$start_mem = memory_get_usage();
$start_time = microtime(true);
function xrange($start, $limit, $step = 1) {
    if ($start < $limit) {
        if ($step <= 0) {
            throw new LogicException('Step must be +ve');
        }

        for ($i = $start; $i <= $limit; $i += $step) {
            yield $i;
        }
    } else {
        if ($step >= 0) {
            throw new LogicException('Step must be -ve');
        }

        for ($i = $start; $i >= $limit; $i += $step) {
            yield $i;
        }
    }
}

/*$data = [];
for ($i=0; $i < 100000; $i++) { 
    $data[] = $i;
}

foreach ($data as $key => $value) {
    echo $value;
}*/

function xh() {
    for ($i=0; $i < 100000; $i++) { 
        yield $i;
    }
}

foreach (xh() as $key => $value) {
    echo $value;
}

/* 
 * 注意下面range()和xrange()输出的结果是一样的。
 */

echo 'Single digit odd numbers from range():  ';
foreach (range(1, 9, 2) as $number) {
    echo "$number ";
}
echo "\n";

echo 'Single digit odd numbers from xrange(): ';
foreach (xrange(9, 1, -2) as $number) {
    echo "$number ";
}

$end_mem = memory_get_usage();
$end_time = microtime(true);

echo '<br>';
echo '<br>';
echo '<br>';
echo $end_mem - $start_mem;
echo '<br>';
echo '<br>';
echo '<br>';
echo $end_time - $start_time;
?>
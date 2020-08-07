<?php
function xrange($start, $end, $step = 1) {
    for ($i = $start; $i <= $end; $i += $step) {
        yield $i;
    }
}
/*foreach (xrange(1, 1000000) as $num) {
    echo $num, "\n";
}*/

$range = xrange(1, 1000000);
var_dump($range); // object(Generator)#1
var_dump($range instanceof Iterator); // bool(true)

echo $range->current();

$range->rewind();

echo $range->current();
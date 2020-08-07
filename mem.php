<?php
function convert($size)
{
    $unit=array('b','kb','mb','gb','tb','pb');
    return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
}

echo '分配：';
echo convert(memory_get_usage(true)); // 123 kb
echo '<br>';
echo '实际：';
echo convert(memory_get_usage()); // 123 kb

echo '<br>';

echo log(8, 2);
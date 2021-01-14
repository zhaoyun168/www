<?php
list($t1, $t2) = explode(' ', microtime());
$st = (float)sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);

$splq = new SplQueue;
for($i = 0; $i < 100000; $i++)
{
    $data = "hello $i\n";
    $splq->push($data);

    if ($i % 100 == 99 and count($splq) > 100)
    {
        $popN = rand(10, 99);
        for ($j = 0; $j < $popN; $j++)
        {
            $splq->shift();
        }
    }
}
list($t1, $t2) = explode(' ', microtime());
$et = (float)sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);

echo $et - $st;
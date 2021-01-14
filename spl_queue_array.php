<?php
list($t1, $t2) = explode(' ', microtime());
$st = (float)sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
$arrq = array();
for($i = 0; $i <100000; $i++)
{
    $data = "hello $i\n";
    array_push($arrq, $data);
    if ($i % 100 == 99 and count($arrq) > 100)
    {
        $popN = rand(10, 99);
        for ($j = 0; $j < $popN; $j++)
        {
            array_shift($arrq);
        }
    }
}
/*$popN = count($arrq);
for ($j = 0; $j < $popN; $j++)
{
    array_shift($arrq);
}*/

list($t1, $t2) = explode(' ', microtime());
$et = (float)sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);

echo $et - $st;
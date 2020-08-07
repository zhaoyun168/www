<?php

/*$data = range(1, 100);

$queue = new SplQueue;
//入队
$queue->push($data);
//出队
$data = $queue->shift();

print_r($data);

echo '<br>';
//查询队列中的排队数量
echo $n = count($queue);*/

$splq = new SplQueue;
for($i = 0; $i < 1000000; $i++)
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

$popN = count($splq);
for ($j = 0; $j < $popN; $j++)
{
    $splq->pop();
}
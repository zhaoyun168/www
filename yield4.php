<?php

//对某一数组进行加权处理  
$numbers = array('nike' => 200, 'jordan' => 500, 'adiads' => 800);  
  
//通常方法，如果是百万级别的访问量，这种方法会占用极大内存  
function rand_weight($numbers)  
{  
    $total = 0;  
    foreach ($numbers as $number => $weight) {  
        $total += $weight;  
        $distribution[$number] = $total;  
    }  
    $rand = mt_rand(0, $total-1);  
  
    foreach ($distribution as $num => $weight) {  
        if ($rand < $weight) return $num;  
    }  
}  
  
//改用yield生成器  
function mt_rand_weight($numbers) {  
    $total = 0;  
    foreach ($numbers as $number => $weight) {  
        $total += $weight;  
        yield $number => $total;  
    }  
}  
  
function mt_rand_generator($numbers)  
{  
    $total = array_sum($numbers);  
    $rand = mt_rand(0, $total -1);  
    foreach (mt_rand_weight($numbers) as $num => $weight) {  
        if ($rand < $weight) return $num;  
    }  
}  
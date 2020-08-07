<?php
require('yield_scheduler.php');
require('yield_task.php');

function task1() {
    for ($i = 1; $i <= 10; ++$i) {
        echo "This is task 1 iteration $i.\n";
        yield;
    }
}
function task2() {
    for ($i = 1; $i <= 5; ++$i) {
        echo "This is task 2 iteration $i.\n";
        yield;
    }
}

function task3() {
    for ($i = 1; $i <= 10; ++$i) {
        echo "This is task 3 iteration $i.\n";
        yield;
    }
}

$scheduler = new Scheduler;
$scheduler->newTask(task1());
$scheduler->newTask(task2());
$scheduler->newTask(task3());
$scheduler->run();
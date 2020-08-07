<?php
  
$queue = new SplQueue();
$queue->enqueue('A');
$queue->enqueue('B');
$queue->enqueue('C');

$queue->rewind();
while($queue->valid()){
    echo $queue->current(),"\n";
    $queue->next();
}

print_r($queue);
$queue->dequeue(); //remove first one
print_r($queue);

?>
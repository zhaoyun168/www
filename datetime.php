<?php

$expireTime = strtotime((new \DateTime())->add(new \DateInterval('P1D'))->format('Y-m-d'));

echo $expireTime;
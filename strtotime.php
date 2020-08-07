<?php
ini_set('date.timezone','Asia/Shanghai');

echo strtotime(date('Y-m-d 00:00:00', strtotime('-1 days')));
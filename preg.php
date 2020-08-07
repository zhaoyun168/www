<?php

$str = 'YYGH0008|患者已经进入黑名单，不能预约';

echo preg_replace('/^.*?\|/','', $str);
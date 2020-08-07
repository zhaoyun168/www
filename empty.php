<?php
$var = '0';

echo empty($var) ? (is_numeric($var) ? '0' : '') : $var;
<?php

echo intval(strval(0.000001 * 1000000));
echo '<br>';
var_dump(bcmul(sprintf('%.6f', 0.000001), 1000000));
echo '<br>';
var_dump(bcmul((string) 0.000001, (string) 1000000));
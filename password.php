<?php
function password_old($pw)
{
    $decor = md5('yb_');
    $mi    = md5($pw);
    return substr($decor, 0, 12) . $mi . substr($decor, -4, 4);
}

$pw = '123456';
echo password_old($pw);
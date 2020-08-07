<?php
echo '1';
echo '<br>';
assert('1==2');
echo '2';
echo '<br>';
echo '3';

// 设置回调函数
assert_options(ASSERT_CALLBACK, 'myAssert');

// 函数
function myAssert($file, $line, $code, $desc)
{
    echo "Assertion Failed: File {$file} Line {$line} Code {$code} Desc {$desc} ";
}

// 执行
assert(true == false, '不可能相等');
<?php
/*$yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
$order_no = $yCode[intval(date('Y')) - 2011] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99))*/;


/*function getOrderId($prefix = 'DD')
{
    return $prefix . (strtotime(date('YmdHis', time()))) . substr(microtime(), 2, 6) . sprintf('%03d', rand(0, 999));
}*/

function generate_order_number($prefix = '')
{
    $prefix = !empty($prefix) ? $prefix : '';
    $order_number = $prefix . date('Ymd') . substr(strtotime(date('YmdHis', time())), 5) . substr(microtime(), 2, 6) . sprintf('%03d', rand(0, 999));
    //$order_number = $prefix . date('Ymd') . substr(implode(null, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);

    return $order_number;
}


function set_nonce($length = 6 , $numeric = 0){
    PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
    if($numeric) {
        $hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
    } else {
        $hash = '';
        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
        $max = strlen($chars) - 1;
        for($i = 0; $i < $length; $i++) {
            $hash .= $chars[mt_rand(0, $max)];
        }
    }
    return $hash;
}

/**
 * 获取惟一订单号
 * @return string
 */
function get_order_sn()
{
    return date('Ymd') . substr(implode(null, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
}


function get_md5_order()
{
    return md5(uniqid(md5(microtime(true)), true));
}

echo $order_no = get_md5_order();


file_put_contents('order_no', $order_no . "\r\n", FILE_APPEND);


//echo '<br>';

//echo md5(uniqid(md5(microtime(true)), true));
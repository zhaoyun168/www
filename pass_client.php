<?php
/**
 * 加密客户端
 */

$private_key = file_get_contents(dirname(__FILE__).'/rsa_private_key.pem'); //rsa私钥

$public_key = file_get_contents(dirname(__FILE__).'/rsa_public_key.pem'); //rsa公钥

$data = [
	'name' => 'zhangsan',
	'sex' => '男',
	'age' => 20
];
$user = 'weixin_tf';
$pass = 'weixin_tf';
ksort($data);
echo $key  = set_nonce(16, 0);
echo '<br>';
$request = encrypt(json_encode($data), $key);
$http_data = [
    'body' => $request,
    'user' => $user,
    'pass' => $pass,
    'sign' => http_sign(json_encode($data), $private_key),
    'key'  => key_encrypt($key, $public_key),
];

print_r($http_data);

echo '<br>';
echo '<br>';
echo '<br>';

if ($http_data['user'] == 'weixin_tf' && $http_data['pass'] == 'weixin_tf') {
    //rsa私钥解密
    echo $jm_key = key_decrypt($http_data['key'], $private_key);

    //参数解密
    $jm_data = decrypt($http_data['body'], $jm_key);

    $jm_data = json_decode($jm_data, true);

    print_r($jm_data);

    echo '<br>';

    ksort($jm_data);
    //验签
    $jm_sign = http_sign(json_encode($jm_data), $private_key);

    if ($jm_sign == $http_data['sign']) {
        echo '验签成功!';
    }
    
}

//aes加密
function encrypt($data, $key)
{
    $encrypt = openssl_encrypt($data, 'AES-128-ECB', $key, OPENSSL_RAW_DATA);
    return base64_encode($encrypt);
}

//aes解密
function decrypt($data, $key)
{
    $decrypt = openssl_decrypt(base64_decode($data), 'AES-128-ECB', $key, OPENSSL_RAW_DATA);
    return $decrypt;
}

//接口sign签名
function http_sign($data, $private_key)
{
    //转换为openssl密钥，必须是没有经过pkcs8转换的私钥
    $res = openssl_get_privatekey($private_key);
    //调用openssl内置签名方法，生成签名$sign
    openssl_sign($data, $sign, $res, 'SHA256');
    openssl_free_key($res);
    $sign = base64_encode($sign);
    return $sign;

}

//rsa公钥加密
function key_encrypt($data, $public_key)
{
    $pu_key = openssl_pkey_get_public($public_key);
    openssl_public_encrypt($data, $encrypted, $pu_key); //公钥加密
    return base64_encode($encrypted);
}

//rsa私钥解密
function key_decrypt($data, $private_key)
{
    $pr_key  = openssl_pkey_get_private($private_key);
    $data    = base64_decode($data);
    openssl_private_decrypt($data, $decrypt, $pr_key);
    openssl_free_key($pr_key);
    return $decrypt;

}

/**
 * 返回随机号
 * @param number $length  返回随机数长度
 * @param number $numeric  返回随机数类型  1 为随机数字 0 为英文数字组合
 * @return string
 */
function set_nonce($length = 6, $numeric = 0)
{
    PHP_VERSION < '4.2.0' && mt_srand((double) microtime() * 1000000);
    if ($numeric) {
        $hash = sprintf('%0' . $length . 'd', mt_rand(0, pow(10, $length) - 1));
    } else {
        $hash  = '';
        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
        $max   = strlen($chars) - 1;
        for ($i = 0; $i < $length; $i++) {
            $hash .= $chars[mt_rand(0, $max)];
        }
    }
    return $hash;
}


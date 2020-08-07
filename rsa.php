<?php
header('Content-Type: text/plain;charset=utf-8');
$data = 'phpbest';
echo '原始内容: '.$data."\n";
openssl_public_encrypt($data, $encrypted, file_get_contents(dirname(__FILE__).'/rsa_public_key.pem'));
echo '公钥加密: '.base64_encode($encrypted)."\n";
//$encrypted = base64_decode('nMD7Yrx37U5AZRpXukingESUNYiSUHWThekrmRA0oD0=');
openssl_private_decrypt($encrypted, $decrypted, file_get_contents(dirname(__FILE__).'/rsa_private_key.pem'));
echo '私钥解密: '.$decrypted."\n";

/*
openssl genrsa -out rsa_private_key.pem 2048
openssl rsa -pubout -in rsa_private_key.pem -out rsa_public_key.pem
*/
?>
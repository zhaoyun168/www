<?php
$connection = new \AMQPConnection(array('host' => '88.9.1.244', 'port' => '5672', 'vhost' => '/', 'login' => 'admin', 'password' => 'jlsyb2019!'));
if($connection->connect()){
        echo 'success';
} else {
        echo 'fail';
}
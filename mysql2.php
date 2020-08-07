<?php

class DB {
	private static $_instance;
	private $db;

	private function __construct()
	{
		$this->db = mysqli_connect('192.168.100.107', 'root', '');
        mysqli_select_db($this->db, 'yb_settlement');
        mysqli_query($this->db,"SET NAMES utf8");

        return $this->db;
	}
	public static function getInstance()
	{
		if (!(self::$_instance instanceof DB)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	private function __clone()
	{
		
	}

	public function getConn()
	{
		return $this->db;
	}

	public static function query($conn, $sql)
    {
        $result = mysqli_query($conn, $sql);
        $res = mysqli_fetch_assoc($result);

        return $res;
    }
}

$conn = DB::getInstance()->getConn();

$result = DB::query($conn, 'select * from yb_pay');

print_r($result);

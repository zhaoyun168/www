<?php
namespace test;
/**
 * 
 */
class People
{
	
	function __construct()
	{
		echo 'parent';
	}

	public function test()
	{
		return 'test';
	}
}
/**
 * 反射类
 */
class User extends People
{
	private $name;
	function __construct()
	{
		parent::__construct();
	}

	public function test()
	{
		return true;
	}
}


$user = new User();

$user1 = new \ReflectionClass('test\User');

print_r($user1->getName());

print_r($user1->getProperties());

var_dump($user1->hasMethod('abc'));
var_dump($user1->hasMethod('test'));
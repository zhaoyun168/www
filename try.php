<?php


test();

function test() {
	try {
		throw new Exception("Error Processing Request", 1);
	} catch (\Exception $e) {

		$i = $j;
		$e->getMessage();
	}
}
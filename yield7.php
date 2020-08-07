<?php
function gen() {
	while (true) {
		yield "gen\n";
	}
}

$gen = gen();

var_dump($gen instanceof Iterator);
echo "hello, world!";
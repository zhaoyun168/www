<?php
function loadprint( $class ) {
 $file = $class . '.class.php';
 if (is_file($file)) {
 require_once($file);
 }
}
spl_autoload_register( 'loadprint' );
$obj = new PRINTIT();
$obj->doPrint();?>
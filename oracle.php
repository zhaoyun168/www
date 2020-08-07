<?php

$conn = oci_connect('test', '123456', '192.168.100.30/PDB1');

if (!$conn) {

  $e = oci_error();

  print htmlentities($e['message']);

  exit;

}else {

  echo "连接oracle成功！";

   $select = "select * from test";
    //WriteLog($select);
    $result_rows = oci_parse($conn, $select); // 配置SQL语句，执行SQL
    $row_count = oci_execute($result_rows, OCI_DEFAULT); // 行数  OCI_DEFAULT表示不要自动commit 

    print_r($row_count);

}

?>
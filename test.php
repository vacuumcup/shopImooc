<?php

require_once 'include.php';
var_dump(connect());
$sql = "select * from imooc_admin";
print_r(fetchOne($sql));
print_r(update("imooc_admin",$sql));
/*$result = mysqli_query(connect() ,$sql);
	$row = mysqli_num_rows($result);
	print_r($row);*/
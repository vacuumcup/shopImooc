<?php

$link=mysqli_connect("localhost","root","") or die("数据库连接失败Error:".mysql_errno().":".mysql_error());
mysqli_set_charset($link , "utf8" );
mysqli_select_db($link ,"shopImooc") or die("指定数据库打开失败");
/*$arr = $_POST;
$arr['password']=md5($_POST['password']);
if (insert("imooc_admin",$arr)) {
	$mes = "添加成功！<br/><a href='addAdmin.php'>继续添加</a>|<a href='listAdmin.php'>查看管理员</a>";
}else{
	$mes = "添加失败！<br/><a href='addAdmin.php'>重新添加</a>";
}
return $mes;*/

/*function insert($array,$table){
	$link=mysqli_connect("localhost","root","") or die("数据库连接失败Error:".mysql_errno().":".mysql_error());
	mysqli_set_charset($link , "utf8" );
	mysqli_select_db($link ,"shopImooc") or die("指定数据库打开失败");
	$keys = join(",",array_keys($array));
	$vals = "'".join("','",array_values($array))."'";
	$sql = "insert into {$table}($keys) values({$vals})";
	$res= mysqli_query($link,$sql);
	if ($res) {
		echo	"asdas";
	}else{
		echo mysqli_errno($link ).mysqli_error($link )  ;
	}
	return mysqli_insert_id($link);
}*/


function connect(){
	$link=mysqli_connect("localhost","root","") or die("数据库连接失败Error:".mysql_errno().":".mysql_error());
	mysqli_set_charset($link , "utf8" );
	mysqli_select_db($link ,"shopImooc") or die("指定数据库打开失败");
	return $link;
}
/**
 * 完成记录插入的操作
 * @param  [type] $table [description]
 * @param  [type] $array [description]
 * @return [type]        [description]
 */
$array = array( "username" => "aaasqhhhw" ,"password" => "qq12aq","email" => "asd@asd");
$table = "imooc_admin";
function insert($table,$array){
	$keys = join(",",array_keys($array));
	$vals = "'".join("','",array_values($array))."'";
	$sql = "insert into {$table}($keys) values({$vals})";
	mysqli_query(connect(),$sql);
	return mysqli_insert_id(connect());
}
print_r(insert($array,$table));
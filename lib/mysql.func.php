<?php
/**
 * 连接数据库
 * @return [type] [description]
 */
/*function connect(){
	$link=mysql_connect("DB_HOST","DB_USER","") or die("数据库连接失败Error:".mysql_errno().":".mysql_error());
	mysql_set_charset(DB_CHARSET);
	mysql_select_db(DB_DBNAME) or die("指定数据库打开失败");
	return $link;
}*/
function connect(){
	$link=mysqli_connect(DB_HOST,DB_USER,DB_PWD) or die("数据库连接失败Error:".mysql_errno().":".mysql_error());
	mysqli_set_charset($link,DB_CHARSET);
	mysqli_select_db($link,DB_DBNAME) or die("指定数据库打开失败");
	return $link;
}
/**
 * 完成记录插入的操作
 * @param  [type] $table [description]
 * @param  [type] $array [description]
 * @return [type]        [description]
 */

function insert($table,$array){
	$link = connect();
	$keys=join(",",array_keys($array));
	$vals="'".join("','",array_values($array))."'";
	$sql="insert {$table}($keys) values({$vals})";
	mysqli_query($link,$sql);
	return mysqli_insert_id($link);
}
/**
 * 记录的更新操作
 * @param  string $table [description]
 * @param  array $array [description]
 * @param  number $where [description]
 * @return [type]        [description]
 */
function update($table,$array,$where = null){
	//$link = connect();
	foreach ($array as $key => $val) {
		if ($str == null) {
			$sep = "";
		}else{
			$sep = ",";
		}
		$str .= $sep.$key."='".$val."'";
	}
	$sql = "update {$table} set {$str}".($where == null?null:"where ".$where);
	mysqli_query(connect(),$sql);
	return mysqli_affected_rows(connect());
}

/**
 * 删除记录
 * @param  string $table [description]
 * @param  string $where [description]
 * @return [type]        [description]
 */
function delete($table,$where=null){
	$where = ($where == null?null:"where ".$where);
	$sql = "delete from {$table} {$where}";
	mysqli_query(connect(),$sql);
	return mysqli_affected_rows(connect());
}

/**
 * 得到指定一条记录
 * @param  string $sql         [description]
 * @param  string $result_type [description]
 * @return [type]              [description]
 */
function fetchOne($sql,$result_type=MYSQL_ASSOC){
	$result = mysqli_query(connect() ,$sql);
	$row = mysqli_fetch_array($result,$result_type);
	return $row;
}

/**
 * 得到结果集中的所有记录
 * @param  string $sql         [description]
 * @param  string $result_type [description]
 * @return [type]              [description]
 */
function fetchAll($sql,$result_type = MYSQL_ASSOC){
	$result = mysqli_query(connect() ,$sql);
	while ($row = mysqli_fetch_array($result,$result_type)) {
		$rows []= $row;
	}
	return $rows;
}

/**
 * 得到结果集中的记录条数
 * @param  string $sql [description]
 * @return [type]      [description]
 */
function getResultNum($sql){
	$result = mysqli_query(connect() ,$sql);
	return mysqli_num_rows($result);
}
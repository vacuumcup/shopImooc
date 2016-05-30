<?php
/**
 * 检测是否有管理员
 * @param  [type] $sql [description]
 * @return [type]      [description]
 */
function checkAdmin($sql){
	return fetchOne($sql);
}
/**
 * 检测是否有管理员登录
 * @return [type] [description]
 */
function checkLogined(){
	if ($_SESSION['adminId']==""&&$_COOKIE['adminId']=="") {
		alertMes("请先登录","login.php");
	}
}

function addAdmin(){
	$arr = $_POST;
	$arr['password']=md5($_POST['password']);
	if (insert("imooc_admin",$arr)) {
		$mes = "添加成功！<br/><a href='addAdmin.php'>继续添加</a>|<a href='listAdmin.php'>查看管理员</a>";
	}else{
		$mes = "添加失败！<br/><a href='addAdmin.php'>重新添加</a>";
	}
	return $mes;
}

/**
 * 注销管理员
 * @return [type] [description]
 */
function logout(){
	$_SESSION = array();
	if (isset($COOKIE[session_name()])) {
		setcookie(session_name(),"",time()-1);
	}
	if (isset($COOKIE['adminId'])) {
		setcookie("adminId","",time()-1);
	}
	if (isset($COOKIE['adminName'])) {
		setcookie("adminName","",time()-1);
	}
	session_destroy();
	header("location:login.php");
}
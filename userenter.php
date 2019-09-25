<?php
	session_start();
	require "sql.php";
	function validation($name)
	{
		$bool=preg_match("/^[0-9a-zA-Z_]*$/",$name);
		return $bool;
	}
	$conn=connect();
	$userName="";
	$password="";
	if ($_SERVER["REQUEST_METHOD"]=="POST")
	{
		$userName=$_POST['userName'];
		$password=$_POST['userPassword'];
		if (empty($userName)||empty($password)) {
			$valu="请输入不为空的用户名和密码";
			echo json_encode($valu,JSON_UNESCAPED_UNICODE);//返回“请输入不为空的用户名和密码”
			//echo $valu;
			exit();
		}
		$bool=validation($userName);
		$bool1=validation($password);
		if ((!$bool1)||(!$bool)) {
			# code...
			$valu="用户名和密码只能包含字母数字或下划线";
			echo json_encode($valu,JSON_UNESCAPED_UNICODE);//返回“用户名和密码只能包含字母数字或下划线”
			//echo $valu;
			exit();
		}
		$result=select($conn,"username,password","user ","WHERE username=\"".$userName."\" AND password=\"".$password."\"");
		/*if (!$result) {
			# code...
			die("失败！错误原因:".mysqli_error($conn));
		}*/
		$num=mysqli_num_rows($result);
		if ($num==0) {
			# code...
			$valu="密码或用户名错误";
			echo json_encode($valu,JSON_UNESCAPED_UNICODE);//返回“密码或用户名错误”
			//echo $valu;
			exit();
		}
		$_SESSION['username']=$userName;
		$url="location: seekfile.php?path=../upload/".$userName;
		header($url);
	}
	
 ?>

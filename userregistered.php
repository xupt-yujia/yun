<?php
	require "sql.php";
	function validation($name)
	{
		$bool=preg_match("/^[0-9a-zA-Z_]*$/",$name);
		return $bool;
	}
	function ver($name)
	{
		$name=htmlentities($name);
		$name=stripslashes($name);
		return $name;
	}
	$conn=connect();
	if ($_SERVER["REQUEST_METHOD"]=="POST")
	{
		$username=$_POST['username'];
		$nickname=$_POST['nickname'];
		$password=$_POST['password'];
		$enpassword=$_POST['enpassword'];
		$nickname=ver($nickname);
		if (empty($username)||empty($password)||empty($nickname)) {
			$valu="请输入不为空的用户名,昵称和密码";
			echo json_encode($valu,JSON_UNESCAPED_UNICODE);//返回“请输入不为空的用户名和密码”
			//echo $valu."<br>";
			exit();
		}
		$bool=validation($username);
		$bool1=validation($password);
		if ((!$bool1)||(!$bool)) {
			# code...
			$valu="用户名和密码只能包含字母数字或下划线";
			echo json_encode($valu,JSON_UNESCAPED_UNICODE);//返回“用户名和密码只能包含字母数字或下划线”
			//echo $valu;
			exit();
		}
		if (strcmp($password, $enpassword)!=0) {
			# code...
			$valu="密码与确认密码不同！";
			echo json_encode($valu,JSON_UNESCAPED_UNICODE);//返回“密码与确认密码不同！”
			//echo $valu;
			exit();
		}
		//echo $nickname."<br>";
		$result=select($conn,"username","user ","WHERE username=\"".$username."\"");
		$num=mysqli_num_rows($result);
		if ($num>=1) {
			# code...
			$valu="已存在该用户！";
			echo json_encode($valu,JSON_UNESCAPED_UNICODE);//返回“已存在该用户”
			//echo $valu;
			exit();
		}
		$result1=add($conn,"user","(username,password,nickname)","(\"".$username."\",\"".$password."\",\"".$nickname."\")");
		$path="../upload/".$username;
		mkdir($path);
		$result=add($conn,"folder","(foldername,folderpath,username)","(\"".$username."\",\"".$path."\",\"".$username."\")");
		if ($result1&&$result) {
			# code...
			$valu="注册成功！";
			echo json_encode($valu,JSON_UNESCAPED_UNICODE);//返回“注册成功”
			//echo $valu;
			exit();
		}
		$valu="注册失败！";
		echo json_encode($valu,JSON_UNESCAPED_UNICODE);//返回“注册失败”
		//echo $valu;
		exit();
	}
?>
<?php
	session_start();
	require "sql.php";
	if(!isset($_SESSION['username']))
	{
		header("location: 404 Not Found");
	}
	function get()
	{
		if (isset($_GET['path'])) {
			# code...
			$path=$_GET['path'];
			return $path;
		}
		else
		{
			header("location: 404 Not Found");
		}
	}
	$path1=get();
	$conn=connect();
	if (isset($_POST[''])) {
		# code...
		$path=$path1.$_POST[''];		
		$result=select($conn,"*","folder ","WHERE folderpath=\"".$path."\"");
		$num=mysqli_num_rows($result);
		if ($num>=1) {
			# code...
			$valu="已存在该文件夹或文件！";
			echo json_encode($valu,JSON_UNESCAPED_UNICODE);//返回“已存在该文件夹或文件！”
			//echo $valu;
			exit();
		}
		$result=select($conn,"*","file ","WHERE path=\"".$path."\"");
		$num=mysqli_num_rows($result);
		if ($num>=1) {
			# code...
			$valu="已存在该文件夹或文件！";
			echo json_encode($valu,JSON_UNESCAPED_UNICODE);//返回“已存在该文件夹或文件！”
			//echo $valu;
			exit();
		}
		mkdir($path);
		$result1=add($conn,"folder ","(foldername,folderpath,username)","(\"".$username."\",\"".$path."\",\"".$username."\")");
		$result2=select($conn,"folderId","folder ","WHERE folderpath=\"".$path."\"");
		$result3=select($conn,"sonsId","folder ","WHERE folderpath=\"".$path1."\"");		
		if ((!$result1)||(!$result2)||(!$result3)) {
			# code...
			$valu="新建失败！";
			echo json_encode($valu,JSON_UNESCAPED_UNICODE);//返回“新建失败”
			//echo $valu;
			exit();
		}
		$array=mysqli_fetch_row($result2);
		$id=$array[0];		
		$array1=mysqli_fetch_row($result3);
		$sonid=$array1[0];
		$sonid=$sonid."￥".$id;
		$result=update($conn,"floder ","sonsId=\"".$sonid."\" WHERE folderpath=\"".$path1."\"");
		if (!$result) {
			# code...
			$valu="新建失败！";
			echo json_encode($valu,JSON_UNESCAPED_UNICODE);//返回“新建失败”
			//echo $valu;
			exit();
		}
		$valu="新建成功！";
		echo json_encode($valu,JSON_UNESCAPED_UNICODE);//返回“新建成功”
		//echo $valu;
		exit();
	}
	
?>
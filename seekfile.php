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
		return FALSE;
	}
	$path=get();
	$path1="../upload/".$_SESSION['username'];
	if (!$path) {
		# code...
		//die("1");
		header("location: 404 Not Found");
	}
	echo json_encode($path,JSON_UNESCAPED_UNICODE);
	if (is_file($path)) {
		# code...
		$url="location: downfile.php?path=".$path;
		//echo $path;
		header($url);
		exit();
	}
	$dh=opendir($path);
	if (!$dh) {
		# code...
		//die("3");
		header("location: 404 Not Found");
	}
	$file_name=readdir($dh);
	if (strcmp($path, $path1)==0) {
		# code...
		$file_name=readdir($dh);
	}
	$file_name=readdir($dh);
	$i=0;
	while ($file_name!=FALSE) {
		# code...		
		$file_name=mb_convert_encoding($file_name, "UTF-8", "gb2312");		
		//echo $file_name."<br>";
		$file_array[$i]=$file_name;
		$i++;
		$file_name=readdir($dh);
	}
	//$array=scandir($path);
	closedir($dh);
	echo json_encode($file_array,JSON_UNESCAPED_UNICODE);//将该文件夹中的所有文件名打包进一数组返回
	//echo json_encode($array);
?>
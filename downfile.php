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
	}
	$path=get();
	if (!$path) {
		# code...
		//die("4");
		header("location: 404 Not Found");
	}
	//$path="C:/php/wamp64/www/yun/".$path;
	$file_name=basename($path);
	$fp=fopen($path,"r");
	$file_size=filesize($path);
	Header("Content-type: application/octet-stream"); 
	Header("Accept-Ranges: bytes"); 
	Header("Accept-Length:".$file_size); 
	Header("Content-Disposition: attachment; filename=".$file_name); 
	ob_clean(); 
	flush();
	readfile($path);
	fclose($fp);
?>
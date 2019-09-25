<?php
	/*$host="localhost";
	$user_name="root";
	$password="";*/
	function connect()
	{
		$conn=mysqli_connect("localhost","root","");
		/*if (!$conn) {
			 # code...
			 die("链接数据库失败，失败原因".mysqli_error($conn));
		}*/
		mysqli_set_charset($conn,"utf8");
		mysqli_select_db($conn,"yun");
		return $conn;
	}
		
	function select($conn,$field,$table,$sql)
	{
		$result=mysqli_query($conn,"SELECT ".$field." FROM ".$table.$sql);
		return $result;
	}
	function add($conn,$table,$field,$value)
	{
		$result=mysqli_query($conn,"INSERT INTO ".$table." ".$field." VALUE ".$value);
		/*if (!$result) {
			# code...
			die("添加失败！错误原因:".mysqli_error($this->conn));
		}*/
		return $result;
	}
	function update($conn,$table,$sql)
	{
		$result=mysqli_query($conn,"UPDATE ".$table." SET ".$sql);
		/*if (!$result) {
			# code...
			die("修改失败！");
		}*/
		return $result;
	}
	/*function buildTable($conn,$sql)
	{
		$result=mysqli_query($conn,$sql);
		if (!$result) {
				# code...
			die("建表失败！");
		}
		return $result;
	}
	function showtable($conn)
	{
		$result=mysqli_query($conn,"SHOW TABLES");
		if(!$result)
		{
			die("查询失败！");
		}
		return $result;
	}
	function showtablenum($conn)
	{
		$result=mysqli_query($conn,"SHOW TABLES");
		if(!$result)
		{
			die("查询失败！");
		}
		$num=mysqli_affected_rows($conn);
		return $num;
	}*/
	function delect($conn,$table,$sql)
	{
		$result=mysqli_query($conn,"DELETE FROM ".$table.$sql);
		if(!$result)
		{
			die("删除失败！");
		}
		return $result;
	}
	/*function drop($conn,$table)
	{
		$result=mysqli_query($conn,"DROP TABLE ".$table);
 		return $result;
	}*/
	function close($conn)
	{
		mysqli_close($conn);
	}

?>
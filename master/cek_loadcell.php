<?php
 	//connect to database
	require_once 'php_action/db_connect.php';
	
	//read loadcell database;
	$sql = mysqli_query($connect, "select * from loadcell");
	$data = mysqli_fetch_array($sql);
	$nilai = $data["nilai_loadcell"];

	echo $nilai ;
?>
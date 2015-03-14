<?php 
	require_once('utility.php');
	$link = connectDB();
	$id = $_GET['id'];
	$sql = "DELETE FROM `mailbox` WHERE `mailid` = '$id'";
	mysql_query($sql,$link);

	header('location: ../mailbox.php');
 ?>
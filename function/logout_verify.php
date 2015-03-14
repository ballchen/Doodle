<?php
	session_start();
	require_once('utility.php');
	$link = connectDB();
	
	$account = $_SESSION['account'];
	$time = $_SESSION['timestamp'];

	$sql = "UPDATE  `user` SET  `last_login` = '$time' WHERE  `account` = '$account'";

	mysql_query($sql,$link);
	session_unset();
	header('location: ../index.php');
?>
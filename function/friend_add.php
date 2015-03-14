<?php 
	session_start();
	require_once('utility.php');
	$link = connectDB();
	$user_no = $_SESSION['user_no'];
	$f_no = $_GET['no'];
	$content = 'I Want to Be Your Friend! Here is my Page: <a class="ui tear buttun" target="_parent" href="author.php?no='.$user_no.'">click</a>';

	

	$sql = "INSERT INTO `friend` (`user_no`,`friend_no`) VALUES ('$user_no','$f_no')";
	$sql_mail = "INSERT INTO `mailbox` (`sender_no`,`receiver_no`,`content`) VALUES ('$user_no','$f_no','$content')";

	mysql_query($sql,$link);
	mysql_query($sql_mail,$link);
	header('location: ../author.php?no='."$f_no");
?>
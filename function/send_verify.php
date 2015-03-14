<?php 
	require_once('utility.php');
	$link = connectDB();
	$content = $_POST['content'];
	$receiver = $_POST['receiver'];
	$user = $_POST['user'];

	$sql_no = "SELECT * FROM `user` WHERE `name` = '$receiver'";
	$result_no = mysql_query($sql_no,$link);
	$row = mysql_fetch_assoc($result_no);

	$rec_no = $row['user_no'];


	$sql = "INSERT INTO `mailbox` (`sender_no`,`receiver_no`,`content`) VALUES ('$user','$rec_no','$content')";

	mysql_query($sql,$link);
	
 ?>
<body onload="window.close()"> 
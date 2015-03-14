<?php 
	require_once('utility.php');
	$link = connectDB();
	$account=$_POST['account'];
	$password=$_POST['password'];

	$sql_findac="SELECT * FROM user WHERE `account` = '$account'";
	$result_acnum = mysql_num_rows(mysql_query($sql_findac,$link));
	
	$sql_request="SELECT * FROM user WHERE `account` = '$account' and `password` = '$password'";

	$result = mysql_query($sql_request,$link);
	$result_num = mysql_num_rows($result);
	date_default_timezone_set( "Asia/Taipei" );
	

	if($result_acnum == 0)
	{
		header("location: ../index.php?suc=1");

	}
	elseif($result_num == 0)
	{			
		header("location: ../index.php?suc=2");
	}
	elseif($result_num == 1)
	{
		$timestamp = time();
		session_start();
			$_SESSION['account'] = mysql_result($result, 0, "account");
			$_SESSION['name'] = mysql_result($result, 0, "name");
			$_SESSION['user_no'] = mysql_result($result, 0, "user_no");
			$_SESSION['timestamp'] = date('Y-m-d G:i:s');

		header("location: ../index.php?suc=3");
	}
	elseif($result_num >1)
	{
		header("location: ../index.php?suc=4");
	}

	
?>

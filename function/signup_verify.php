<?php 
	require_once ('utility.php');
	$link = connectDB();
	$password = $_POST['password'];
	$passwordv = $_POST['passwordv'];
	$account = $_POST['account'];
	$username = $_POST['username'];
	date_default_timezone_set( "Asia/Taipei" );
	$regtime = date('Y-m-d G:i:s');

	$sql_test="SELECT * FROM `user` WHERE `account`=$account";
	$test = mysql_num_rows(mysql_query($sql_test,$link));

	$sql="INSERT INTO user (`name`,`account`,`password`,`reg_date`) 
	VALUES('$username','$account','$password','$regtime')";

	if($password==$passwordv && !empty($_POST['account']) 
		&& !empty($_POST['username']) && !empty($_POST['password']) && $test==0){
		mysql_query($sql);
		header("location: ../signup.php?suc=1");
	}
	else{
		if($test==0) header("location: ../signup.php?suc=2");
		else if($test != 0) header("location: ../signup.php?suc=3");
	}
?>

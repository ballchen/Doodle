<?php session_start();
date_default_timezone_set( "Asia/Taipei" );
?>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<script src="scripts/semantic/packaged/javascript/semantic.min.js"></script>
	<script src="scripts/jquery.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="scripts/semantic/packaged/css/semantic.min.css">
	<link rel="stylesheet" type="text/css" href="css/font.css">
	<script>
		$(document).ready(function(){

		})
	</script>

</head>
<body>
<?php 
	require_once('function/utility.php');
	$link = connectDB();
	$id=$_GET['id'];
	
	$user_no = $_SESSION['user_no'];

	$sql_getmail = "SELECT * FROM `mailbox`,`user` WHERE `mailbox`.`sender_no` = `user`.`user_no` and
	`mailid` = '$id'";

	$result = mysql_query($sql_getmail,$link); 
	$row = mysql_fetch_assoc($result);
?>
<div class="ui segment">
	<div style="height:10%;">From <?php echo $row['name'] ?></div>
	<div style="height:70%;"><?php echo $row['content'] ?></div>
	<div>
		<a href="javascript:window.close();" class="ui teal button"> Close</a>
	</div>
</div>
<?php include('template/_site_footer.php'); ?>
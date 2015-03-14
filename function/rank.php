<?php 

require_once("utility.php");
$link = connectDB();

$user_no=$_POST['user_no'];

$sql="SELECT * FROM `rank_history` WHERE `user_no` ='$user_no' ORDER BY `order` DESC";
$result=mysql_query($sql, $link); 
$row=mysql_fetch_assoc($result);
$order=$row['order']+1;

$status=$_POST['status'];
$point=-2;
if($status==1)
{
	$point=3;
}


$sql="INSERT INTO `rank_history` (`user_no`, `order`, `point`) 
VALUES ('$user_no', '$order', '$point')";
mysql_query($sql, $link);
$sql_user="UPDATE `user` SET `elo` = `elo`+'$point' WHERE `user_no` = '$user_no'";
mysql_query($sql_user, $link);

?>
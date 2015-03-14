<?php
require_once("function/utility.php");
$link = connectDB();

$pic_no=$_POST['pic_no'];
$user_no=$_POST['user_no'];
$content=$_POST['content'];
$user_no_byGET=$_POST['user_no_byGET'];


$sql="SELECT * FROM `pic_comment` ORDER BY `order` DESC ";
$result=mysql_query($sql, $link); 
$row = mysql_fetch_assoc($result);
$order=$row['order']+1;

$sql="INSERT INTO `pic_comment` (`order`, `pic_no`, `user_no`, `content`) 
VALUES ('$order', '$pic_no', '$user_no', '$content')";
mysql_query($sql, $link);

header("location: old_draw.php?user_no=$user_no_byGET&pic_no=$pic_no");
?>
<?php 
require_once("utility.php");
$link = connectDB();

$order = $_POST['order'];
$number= $_POST['pic_no'];
$cate = $_POST['cate'];
if($cate==0)
{
	$sql="DELETE FROM `brush_pic` WHERE `pic_no` = '$number' AND `order` = '$order'";
}
else if($cate==1)
{
	$sql="DELETE FROM `brush_pic` WHERE `pic_no` = '$number'";

}
mysql_query($sql, $link);
 ?>
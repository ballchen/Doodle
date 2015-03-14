<?php
require_once("utility.php");
$link = connectDB();
$cate=$_POST['cate'];

if($cate==1)//找自己
{
	//找user_no
/*$sql="SELECT `pic_no` FROM `user` WHERE";
$result=mysql_query($sql, $link); 
$row = mysql_fetch_assoc($result);
$user_no=$row['user_no'];
*/
$user_no=2;

	//列出所有圖
$sql="SELECT * FROM `author` WHERE `user_no`='$user_no' ORDER BY `pic_no` DESC";
$result1=mysql_query($sql, $link); 
$row1;
while($row1 = mysql_fetch_assoc($result1))
{
	echo "<div style='height:163.69px; background-color:white;' class='ui image'>";
	//列出所有筆刷路徑
	$temp=$row1['pic_no'];
$sql="SELECT * FROM `brush_pic` WHERE `pic_no` ='$temp' ORDER BY `order` ASC ";
$result2=mysql_query($sql, $link); 
$row2;
while($row2 = mysql_fetch_assoc($result2))
{	
	$path=$row2['path'];
	$color=$row2['color_no'];
	$width=$row2['brush_no'];

//列出所有顏色
$sql="SELECT * FROM `color` WHERE `color_no`= '$color'";
$result_c=mysql_query($sql, $link); 
$c=mysql_fetch_assoc($result_c);
$color=$c['color'];

//列出所有筆刷寬度
$sql="SELECT * FROM `brush` WHERE `brush_id`= '$width'";
$result_b=mysql_query($sql, $link); 
$b=mysql_fetch_assoc($result_b);
$width=$b['width'];


echo "<svg class='painting' width='100%' height='100%' viewBox='0 0 1008 550' xmlns='http://www.w3.org/2000/svg' version='1.1' style='position:absolute;'>";
echo "<path d='$path'";

echo " stroke='", $color,"' stroke-width='", $width ,"' fill='none' /></svg>";
}//3
echo "</div>";

}//1
?>
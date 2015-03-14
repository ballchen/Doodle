<?php
session_start();
date_default_timezone_set( "Asia/Taipei" );
require_once("utility.php");
$link = connectDB();
$cate=$_POST['cate'];

if($cate==1)//找自己
{
//找user_no
$account=$_SESSION['account'];
$sql="SELECT * FROM `user` WHERE `account`='$account'";
$result=mysql_query($sql, $link);
$row = mysql_fetch_assoc($result);
$user_no=$row['user_no'];

	//列出所有圖
$sql="SELECT * FROM `author` WHERE `user_no`='$user_no' ORDER BY `pic_no` DESC";
$result1=mysql_query($sql, $link); 
$row1;
while($row1 = mysql_fetch_assoc($result1))
{
	$temp=$row1['pic_no'];
	echo "<<div class='ui image'><a href='old_draw.php?user_no=$user_no&pic_no=$temp' style='width:300px;height:163.69px; background-color:white;
	 border-style:solid; border-width:1px; border-color:#e3e3e3;' class='ui image'>";
	//列出所有筆刷路徑
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
$sql="SELECT * FROM `user` WHERE `user_no`='$user_no' ";
$result3=mysql_query($sql, $link); 
$row3 = mysql_fetch_assoc($result3);
$name= $row3['name'];
echo "<a href='author.php?no=$user_no' style='postition:relative; width:50px; float:left;'>$name</a>";
echo "</a></div>";

}//1
}
else if($cate==0)//找所有人
{
	//列出所有圖
$sql="SELECT * FROM `author` ORDER BY `pic_no` DESC";
$result1=mysql_query($sql, $link); 
$row1;
while($row1 = mysql_fetch_assoc($result1))
{
	$temp=$row1['pic_no'];
	$user_no=$row1['user_no'];
	echo "<div class='ui image'><a href='old_draw.php?user_no=$user_no&pic_no=$temp' style='width:300px;height:163.69px; background-color:white;
	 border-style:solid; border-width:1px; border-color:#e3e3e3;' class='ui image'>";
	//列出所有筆刷路徑
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

$sql="SELECT * FROM `user` WHERE `user_no`='$user_no' ";
$result3=mysql_query($sql, $link); 
$row3 = mysql_fetch_assoc($result3);
$name= $row3['name'];
echo "<a href='author.php?no=$user_no' style='postition:relative; width:50px; float:left;'>$name</a>";
echo "</a></div>";

}//1
}
			
mysql_free_result($result1);
mysql_free_result($result2);
mysql_free_result($result_c);
mysql_free_result($result_b);

?>
<?php
require_once("utility.php");
$link = connectDB();

$pic_no=$_POST['pic_no'];
$order=$_POST['order'];
$i=0;
$x0 = $_POST['x0'];
$y0 = $_POST['y0'];
$coorx = $_POST['coorx'];
$coory = $_POST['coory'];
$width = $_POST['width'];
$color = $_POST['color'];
$error_det=0;
$path="M$x0 $y0 ";


/*
red #FF0000
      <a class="item">橙</a>#FF8000
      <a class="item">黃</a>#FFFF00
      <a class="item">綠</a>#00FF00
      <a class="item">藍</a>#0000FF
      <a class="item">靛</a>#8A2BE2
      <a class="item">紫</a>#A757A8
      <a class="item">黑</a>#000000
      <a class="item">白</a>#FFFFFF
      */
/*echo "Your mouse moves from (0, 0) to ";
while(!empty($coorx[$i]))
{
	$x=$coorx[$i]-$x0;
	$y=$y0-$coory[$i];
	echo "($x, $y) ";
	$i=$i+1;
}
$i=0;
echo "<br>";*/

//path處理

while(!empty($coorx[$i]))
{
	$x=$coorx[$i];
	$y=$coory[$i];
	$path=$path."L$x $y ";
	$i=$i+1;
}
//存入db

$sql="INSERT INTO `brush_pic` (`pic_no`, `order`, `path`, `brush_no`, `color_no`) 
VALUES ('$pic_no', '$order', '$path', '$width', '$color')";
mysql_query($sql, $link);




//回傳html
			if($color==0)
			{
				$color='#FF0000';
			}
			else if($color==1)
			{
				$color='#FF8000';
			}
			else if($color==2)
			{
				$color='#FFFF00';
			}
			else if($color==3)
			{
				$color='#00FF00';
			}
			else if($color==4)
			{
				$color='#0000FF';
			}
			else if($color==5)
			{
				$color='#8A2BE2';
			}
			else if($color==6)
			{
				$color='#A757A8';
			}
			else if($color==7)
			{
				$color='#000000';
			}
			else if($color==8)
			{
				$color='#FFFFFF';
			}
			$width=$width*2+1;
echo "<svg class='painting' xmlns='http://www.w3.org/2000/svg' version='1.1' style='position:absolute;width:100%;height:100%;'>";
echo "<path d='$path'";

echo " stroke='", $color,"' stroke-width='", $width ,"' fill='none' /></svg>";

?> 



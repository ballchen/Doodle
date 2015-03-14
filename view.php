<?php 
include('template/_site_header.php');
require_once("function/utility.php");
$link = connectDB();
?>

<html>
<head>
	<meta charset="UTF-8">
	<title></title>
	<script src="scripts/semantic/packaged/javascript/semantic.min.js"></script>
	<script src="scripts/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="scripts/semantic/packaged/css/semantic.min.css">
	<script>
		$(document).ready(function(){
			var cate=0;
		$(".search").click( function() {
          $('#picimg').fadeOut(100);
			cate=$(this).index();
			$(".search").removeClass('active');
			$(this).addClass('active');

         $.ajax({
         url: 'function/self_view.php',
         cache: true,
         dataType: 'html',
             type:'POST',
         data: { cate:cate },
         error: function(xhr) {
           alert('Ajax request 發生錯誤');
         },
         success: function(response) {
                   $('#picimg').html(response);
                   $('#picimg').fadeIn(100);
         }
        });//end ajax
		})//end search

		})
	</script>
</head>
<style type="text/css">
	body{
		background: url(image/view_bg.png);
		background-size: 100%;
	}
	.mainframe
	{
		left:2%;
		width:96%;
	}
	#pictures{
		position: absolute;
		top:15%;
		left: 16%;
		width:68%;
	}
	#picimg
	{
		margin-top:2%;
	}
</style>
</style>
<body>
	<div id="pictures">
		<div>
			<div class="ui menu">
			  <a class="active item search">
			    <i class="home icon"></i> All
			  </a>
			  <a class="item search">
			    <i class="mail icon"></i> Self
			  </a>
			  <div class="right menu">
			    <div class="item">
			      <div class="ui icon input">
			        <input type="text" placeholder="Search...">
			        <i class="search link icon"></i>
			      </div>
			    </div>
			  </div>
			</div>
		</div>
		<div id="picimg" class="ui medium images">
<?php

//列出所有圖
$sql="SELECT * FROM `author` ORDER BY `pic_no` DESC";
$result1=mysql_query($sql, $link); 
$row1;
while($row1 = mysql_fetch_assoc($result1))
{
	$temp=$row1['pic_no'];
	$user_no=$row1['user_no'];
	echo "<div class='ui image'> <a href='old_draw.php?user_no=$user_no&pic_no=$temp' style='width:300px;height:163.69px; background-color:white; 
		border-style:solid; border-width:1px; border-color:#e3e3e3;' class='ui image' >";
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


echo "<svg class='painting' viewBox='0 0 1008 550' xmlns='http://www.w3.org/2000/svg' version='1.1' style='position:absolute; width:100%; height:100%;'>";
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
			
mysql_free_result($result1);
mysql_free_result($result2);
mysql_free_result($result_c);
mysql_free_result($result_b);
?>
		</div>

	</div>
</body>
</html>
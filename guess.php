<?php 
include('template/_site_header.php');
require_once("function/utility.php");
$link = connectDB();
if(!isset($_SESSION['account']))
{
  header('location: index.php?suc=4');
}
else{
//找user_no
$account=$_SESSION['account'];
$sql="SELECT * FROM `user` WHERE `account`='$account'";
$result=mysql_query($sql, $link);
$row = mysql_fetch_assoc($result);
$user_no=$row['user_no'];
}
?>

<html>
<head>
	<meta charset="UTF-8">
	<title></title>
	<script src="scripts/semantic/packaged/javascript/semantic.min.js"></script>
	<script src="scripts/jquery.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="scripts/semantic/packaged/css/semantic.min.css">
	<script type="text/javascript">
		$(document).ready(function(){
			var ans_num=<?php 
			$ans_num = rand(1,3);
			echo "$ans_num"; ?>;
			ans_num=ans_num-1;
			var user_no=<?php echo "$user_no"; ?>;
			var status=0;

			$(".teal").click(function(){
				if(ans_num==$(this).index())
				{
					status=1;
				}
				if(status==1)
				{
					alert("猜對了啊不就好棒棒   賞你3分");	
				}
				else
				{
					alert("猜錯哭哭ㄛ  還被扣了2分");
				}
				$.ajax({
         url: 'function/rank.php',
         cache: true,
         dataType: 'html',
             type:'POST',
         data: { status:status, user_no:user_no },
         error: function(xhr) {
           alert('Ajax request 發生錯誤');
         },
         success: function(response) {
                   $('#btns').html(response);

                    }
        });//end ajax

			})
		})
	</script>
</head>
<style type="text/css">
	body{
		background: url(image/guess-bg.png);
		background-size: 100%;
	}
	#guesspic{
		position: absolute;
		left:25%;
		top:15%;
		width:50%;
		height:50%;
		background-color: white;
	}
	#guesspic img
	{
		width:100%;
		
	}
	#btns
	{
		position: absolute;
		left: 35%;
		width: 30%;
		bottom:10%;
	}
</style>
<body>
			<div id="guesspic">
<?php 
$sql="SELECT * FROM `author` ORDER BY `pic_no` DESC ";
$result1=mysql_query($sql, $link); 
$row1 = mysql_fetch_assoc($result1);
$max=$row1['pic_no'];

$pic_no=rand(1,$max);

$sql="SELECT * FROM `author` WHERE `pic_no` ='$pic_no' ";
$result5=mysql_query($sql, $link); 
$row5=mysql_fetch_assoc($result5);
$ans=$row5['user_no'];

$sql="SELECT * FROM `brush_pic` WHERE `pic_no` ='$pic_no' ORDER BY `order` ASC ";
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


?>
			</div>
			<div id="btns">	
<?php 

$sql="SELECT * FROM `user` WHERE `user_no` ='$ans'";
$result3=mysql_query($sql, $link); 
$row3 = mysql_fetch_assoc($result3);
$ans_name=$row3['name'];

$sql="SELECT * FROM `user`";
$result4=mysql_query($sql, $link); 
$row4 = mysql_fetch_assoc($result4);
$i=1;
$choice1=0;
$choice2=0;
while($i<3)
{
if ($row4['name']==$ans_name) {
	$row4 = mysql_fetch_assoc($result4);
}
else if($choice1==0)
{
	$choice1=$row4['name'];
	$i++;
}
else if($choice2==0)
{
	$choice2=$row4['name'];
	$i++;
}
}//end while
$i2=0;
	for($i=1;$i<=3;$i++)
	{
		if($i==$ans_num)
		{
			echo "<a class='ui teal button'>$ans_name</a>";
		}
		else if($i2==0)
		{
			echo "<a class='ui teal button'>$choice1</a>";
			$i2++;
		}
		else if($i2==1)
		{
			echo "<a class='ui teal button'>$choice2</a>";
		}
	}
 ?>
			</div>


</body>
</html>
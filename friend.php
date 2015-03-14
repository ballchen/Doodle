<?php include('template/_site_header.php'); ?>
<?php 
	require_once("function/utility.php");
	$link = connectDB();
	$account = $_SESSION['user_no'];
	
	$sql = "SELECT * FROM `friend`,`user` WHERE `friend`.`friend_no` = `user`.`user_no` AND `friend`.`user_no` = '$account'";

	$result = mysql_query($sql,$link);	

 ?>
 <style type="text/css">
 .friend
 {
 	left:25%;
 	width:50%;
 }
 </style>
 <div class="ui segment friend">
 	<?php if(mysql_num_rows($result)==0){ ?>
 	<div>NO Friends</div>
 	<?php } ?>
 	<?php 
 	while ($row = mysql_fetch_assoc($result))
 	{ ?>
 	<div>
 		<a href="author.php?no=<?php echo $row['user_no']; ?>"><?php echo $row['name']; ?></a>	 
 	</div>

 	<?php } ?>
 </div>


<?php include('template/_site_footer.php'); ?>
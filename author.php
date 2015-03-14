<?php include('template/_site_header.php') ?>
<?php 
	
	require_once('function/utility.php');
	$link = connectDB();
	$no = $_GET['no'];
	$user_no = $_SESSION['user_no'];
	$sql_get="SELECT * FROM `user` WHERE `user_no` = '$no'";
	$result = mysql_query($sql_get,$link);
	$row = mysql_fetch_assoc($result);

	$sql_friend="SELECT * FROM `friend` WHERE `user_no` = '$user_no' AND `friend_no` = '$no'";
	$row_f = mysql_query($sql_friend,$link);
 ?>
<style type="text/css">
 	#author{
		left:35%;
		width:30%;
		margin-top:7%;
	}
	body
	{
		background:url(image/view_bg.png);
		background-size: 100%;
	}
</style>
<div>
	<div class="ui piled feed segment" id="author">
		<div class="event">
			<div class="label">
				<i class="circular user icon"></i>
			</div>
			<div class="content">
			    <div class="summary">
			    	<?php echo $row['name'] ?>
			    </div>
		    </div>
		</div>
		<div class="event">
			<div class="label">
				<i class="circular time icon"></i>
			</div>
			<div class="content">
			    <div class="summary">
			    	Last login: <?php echo $row['last_login'] ?>
			    </div>
		    </div>
		</div>
		<div class="event">
			<div class="label">
				<i class="circular pencil icon"></i>
			</div>
			<div class="content">
			    <div class="summary">
			    	elo: <?php echo $row['elo'] ?>
			    </div>
		    </div>
		</div>

		<div class="event">
			<div class="label">
				<i class="circular photo icon"></i>
			</div>
			<div class="content">
			    <div class="summary">
			    	See his pictures
			    </div>
		    </div>
		</div>
		<?php if ($user_no == $no): ?>
			<div class="event">
				<div class="label">
					<i class="circular users icon"></i>
				</div>
				<div class="content">
				    <div class="summary">
				    	It's You
				    </div>
			    </div>
			</div>
		
		<?php elseif (isset($_SESSION['account'])&&mysql_num_rows($row_f)==0): ?>
			<a class="ui blue button" href="function/friend_add.php?no=<?php echo $no ?>">
				Be friend
			</a>	
		
		<?php elseif (mysql_num_rows($row_f)!=0): ?>
			<div class="event">
				<div class="label">
					<i class="circular users icon"></i>
				</div>
				<div class="content">
				    <div class="summary">
				    	Friend of Yours
				    </div>
			    </div>
			</div>
		<?php endif ?>
		
	</div>

	
</div>
<?php include('template/_site_footer.php'); ?>
<?php include('template/_site_header.php'); ?>
<?php 
	require_once('function/utility.php');
	$link = connectDB();

	$user_no = $_SESSION['user_no'];

	$sql_getmail = "SELECT * FROM `mailbox`,`user` WHERE `mailbox`.`sender_no` = `user`.`user_no` and
	`receiver_no` = '$user_no' ORDER BY `time` DESC";

	$result = mysql_query($sql_getmail,$link);
	$records_per_page = 5;

	if (isset($_GET["page"])) 
	{
		$page = $_GET["page"] ;
	}
	else
		$page =1;

	$total_records = mysql_num_rows($result);
	$total_pages = ceil($total_records/$records_per_page);
	$started_record = $records_per_page*($page-1) ;
	@mysql_data_seek($result, $started_record);


	?>
<style type="text/css">
	#mailbox{
		left:15%;
		width:70%;
		margin-top:5%;
	}
	body
	{
		background:url(image/view_bg.png);
		background-size: 100%;
	}
	.mailcon
	{
		position: absolute;
		left:0%;
		width:100%;
		height:100%;
		background-color: white;
		
	}
</style>
<script type="text/javascript">
	
	function OpenWin(url) 
	{ 
	    window.open (url, 'mywin', 'height=450, width=400, toolbar=no,location=no, status=no') 
	} 
</script>
<div class="ui page dimmer">
  <div class="content">
    <div class="center">Hello</div>
  </div>
</div>
<div id="mailbox" class="ui piled feed segment">
	<div class="ui menu">
	  <a class="active item">
	    <i class="mail icon"></i> Mailbox
	  </a>
	  <a class="item" href="javascript:OpenWin('send.php');">
	    <i class="mail icon"></i> Send
	  </a>
	</div>
	<?php if ($total_records == 0): ?>
		There is no mail.
	<?php endif ?>
	<?php
		$j =1;
		while($row = mysql_fetch_assoc($result) and $j<=$records_per_page){

	?>
	<div class="event maillogo">
		<div class="label">
			<i class="circular mail icon"></i>
		</div>
		<div class="content">
			<div class="date">
				<?php echo $row['time']; ?>
				<i class="trash icon" onclick="location.href='function/deletemail.php?id=<?php echo $row['mailid']; ?>';"></i>
			</div>
			<div class="summary">
				  <a  href="javascript:OpenWin('mail.php?id=<?php echo $row['mailid'] ?>')" target="_blank" >From <?php echo $row['name']; ?></a>
			</div>					    
		</div>
	</div>
	
	<?php } ?>
	<div>
		<?php 
			echo "<p align = 'center'>";
			if($page>1)
				echo "<a class='ui small button' href ='mailbox.php?page=".($page+1)."'>上一頁</a>";

			for($i=1; $i<=$total_pages;$i++)
			{
				if($i == $page)
				{
					echo "<a class = 'ui small blue button'>$i</a>";
				}
				else
					echo "<a class='ui small button' href='mailbox.php?page=$i'>$i</a>";

			}
			if($page < $total_pages)
				echo "<a class='ui small button' href='mailbox.php?page=".($page+1)."'>下一頁</a>";
		?>
	</div>
</div>


<?php include('template/_site_footer.php'); ?>
<?php session_start();
date_default_timezone_set( "Asia/Taipei" );
$user_no = $_SESSION['user_no'];
?>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<script src="scripts/semantic/packaged/javascript/semantic.min.js"></script>
	<script src="scripts/jquery.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="scripts/semantic/packaged/css/semantic.min.css">
	<link rel="stylesheet" type="text/css" href="css/font.css">
	<script>
		$(document).ready(function(){

		})
	</script>

</head>
<body>
<form method="POST" action="function/send_verify.php">
<div class="ui form segment">
	<div class="field">
	    <label>To</label>
	    <input type="text" name="receiver">
	</div>
	<div class="field">
	    <label>Content</label>
	    <textarea  name="content"></textarea>
	</div>
	<input type="hidden" name="user" value="<?php echo $user_no; ?>">
	<button class="ui blue button" value="submit">Send</button>
</div>
</form>
<?php include('template/_site_footer.php'); ?>
<?php session_start();
date_default_timezone_set( "Asia/Taipei" );
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Doodle</title>
	<script src="scripts/semantic/packaged/javascript/semantic.min.js"></script>
	<script src="scripts/jquery.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="scripts/semantic/packaged/css/semantic.min.css">
	<link rel="stylesheet" type="text/css" href="css/font.css">
	<script>
		$(document).ready(function(){
			$("#logina").click(function(){
				$("#logindiv").animate({top:"-0.5%"},500)
			})
		})
	</script>

</head>
<style type="text/css">
	.mainframe
	{
		left:2%;
		width:96%;
	}
	#logindiv{
		width:50%;
		position: absolute;
		right: 2%;
		height:11%;
		z-index: 101;
		top:-20%;
	}
	#logininner
	{
		height:100%;
	}
	#logininner input
	{
		height:100%;
	}
</style>
<body>
	<div class="mainframe">
		<div class="ui text menu">
			<div class="right menu">
				<a class="item" href="index.php">
					Home
				</a>
				<a class="item" href="draw.php">
					Draw
				</a>
				<a class="item" href="view.php">
					View
				</a>
				<a class="item" href="guess.php">
					Guess
				</a>
				
				<?php if (!isset($_SESSION['account'])): ?>
				<a class="item" id="logina">
			    	<i class="user icon"></i> Login
			  	</a>
				<?php endif ?>
				<?php if (isset($_SESSION['account'])): ?>
				<a class="item" href="friend.php">
					Friend
				</a>
				<a class="item" href="author.php?no=<?php echo $_SESSION['user_no']; ?>">
					User
				</a>
				<a class="item" href="mailbox.php">
					Mailbox
				</a>
				<a class="item" href="function/logout_verify.php">
			    	<i class="user icon"></i> Logout
			  	</a>

				<?php endif ?>
				
			</div>
		</div>
	</div>
	<div id="logindiv">
		<form method="post" action="function/login_verify.php">
			<div id="logininner" class="ui form segment">
				<div class="three fields">
					<div class="field">
						
					    <div class="ui left labeled icon input">
						    <input type="text" placeholder="Account" name="account">
						    <i class="user icon"></i>
						      	
							</div>
					</div>
					<div class="field">
						
					    <div class="ui left labeled icon input">
						    <input type="password" name="password" placeholder="Password">
						    <i class="lock icon"></i>
						      	
						</div>
					</div>
					<div class="field">
						
						<div class="ui buttons">
							<button class="ui button" type="submit">Login</button>
							<div class="or"></div>
	  						<div class="ui positive button" onclick=location.href='signup.php';>Sign</div>
						</div>		
					</div>

				</div>

					
			</div>
		</form>
		
				
	</div>
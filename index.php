<?php session_start(); 
	if ($_GET['suc'] == 1) {
		echo "<script>alert('無此使用者')</script>";
	}
	elseif ($_GET['suc'] == 2) {
		echo "<script>alert('密碼錯誤')</script>";
	}
	elseif ($_GET['suc'] == 3) {
		echo "<script>alert('登入成功')</script>";
	}
	elseif ($_GET['suc'] == 4) {
		echo "<script>alert('請先登入')</script>";
	}
?>
<script type="text/javascript">alert</script>
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
			$("#logina").click(function(){
				$("#logindiv").animate({top:"-0.5%"},500)
			})
		})
	</script>
</head>
<style type="text/css">
	body{
		background: url(image/background.png);
		background-size: 100%;
	}
	
	.choice{
		position: absolute;

		
	}
	.choice img{
		width:90%;
	}

	#draw{
		left:67%;
		top:47%;
	}
	#guess{
		left:69%;
		top:57%;
	}
	#view{
		left:67%;
		top:67%;
	}
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
			
	<div class="mainframe">
		<div class="ui text menu">
			<div class="right menu">
				<?php if (!isset($_SESSION['account'])){ ?>
					<a class="item" id="logina">
				    	Login
				  	</a>

				  	<a class="item" href="signup.php">
				  		Signup
				  	</a>
				<?php }else{ ?>
					<a class="item" href="mailbox.php">
						Mailbox
					</a>
					<div class="item">
						<?php echo "Hello! " ?>
						<a href="user.php"><?php echo $_SESSION['name'] ?></a>
					</div>
					<a class="item" href="function/logout_verify.php">
				    	Logout
				  	</a>
				<?php } ?>
				
			</div>
		</div>
		
	</div>
		<div id="draw" class="choice">
			<a href="draw.php">
				<img src="image/draw.png">
			</a>
			
		</div>	
		<div id="guess" class="choice">
			<a href="guess.php">
				<img src="image/guess.png">
			</a>
			
		</div>
		<div id="view" class="choice">
			<a href="view.php">
				<img src="image/view.png">
			</a>
		</div>
</body>
</html>
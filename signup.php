<?php include('template/_site_header.php'); ?>

<style type="text/css">

	body{
		background:url(image/background.png);
		background-size: 100%;

	}
	#signup{
		left:35%;
		width:30%;
		margin-top:7%;
	}
</style>

	<form method="post" action="function/signup_verify.php">
		<div id="signup" class="ui form error segment">
			<?php if($_GET['suc'] == 2){ ?>
			<div class="ui error message">
				<div class="header">Not Correct</div>
			</div>
			<?php } ?>
			<?php if($_GET['suc'] == 1){ ?>
				<div class="ui blue message">
					<div class="header">Success!</div>
				</div>
			<?php } ?>
			<?php if($_GET['suc'] == 3){ ?>
				<div class="ui yellow message">
					<div class="header">Account Has Been Used</div>
				</div>
			<?php } ?>
		<div class="field">
			
		    <label>User Account</label>
			    <div class="ui left labeled icon input">
			      <input type="text" placeholder="Account" name="account">
			      <i class="user icon"></i>
			      <div class="ui corner label">
			        <i class="icon asterisk"></i>
			      </div>
			    </div>
			  </div>
			  <div class="field">
			    <label>Username</label>
			    <div class="ui left labeled icon input">
			      <input type="text" placeholder="Username" name="username">
			      <i class="user icon"></i>
			      <div class="ui corner label">
			        <i class="icon asterisk"></i>
			      </div>
			    </div>
			  </div>
			  <div class="field">
			    <label>Password</label>
			    <div class="ui left labeled icon input">
			      <input type="password" name="password">
			      <i class="lock icon"></i>
			      <div class="ui corner label">
			        <i class="icon asterisk"></i>
			      </div>
			    </div>
			  </div>
			  <div class="field">
			    <label>Password Again</label>
			    <div class="ui left labeled icon input">
			      <input type="password" name="passwordv">
			      <i class="lock icon"></i>
			      <div class="ui corner label">
			        <i class="icon asterisk"></i>
			      </div>
			    </div>
			  </div>
			  
			  <input class="ui blue submit button" type="submit" value="SignUp">
		</div>
	</form>
	
<?php include('template/_site_footer.php'); ?>
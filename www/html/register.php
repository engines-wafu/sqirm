<?php include "../inc/dbinfo.inc"; ?>
<html>
  <head>
    <style>
      <?php include "class.css"; ?>
      <?php include "server.php"; ?>
    </style>
  </head>
<body>
<h1>Registration Page</h1>

	<div align = "center">
    <div style = "width:300px; border: solid 3px black; " align = "left">
      <div style = "background-color:black; color:white; padding:10px;"><h2>Register</h2></div>
			<div style = "margin:30px">

				<form method="post" action="register.php">
					<div class="container">
						<label>Username</label><input type="text" name="username" value="<?php echo $username; ?>"><br />
						<label>Email</label><input type="email" name="email" value="<?php echo $email; ?>"><br />
						<label>Password</label><input type="password" name="password_1"><br />
						<label>Confirm password</label><input type="password" name="password_2"><br />
						<button type="submit" class="btn" name="reg_user">Register</button>
					</div>
				</form>

			  <div style = "font-size:11px; color:#cc0000; margin-top:10px">
				  <?php include('errors.php'); ?>
        </div>
			</div>
	  </div>
	</div>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>

</body>
</html>

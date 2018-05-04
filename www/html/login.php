<?php
  include "../inc/dbinfo.inc"; 
  session_start();
?>
<html>
  <head>
    <style>
      <?php include "class.css"; ?>
      <?php include "server.php"; ?>
    </style>
  </head>
<body>
<h1>Login Page</h1>

	<div align = "center">
    <div style = "width:300px; border: solid 3px black; " align = "left">
      <div style = "background-color:black; color:white; padding:10px;"><h2>Login</h2></div>
			<div style = "margin:30px">

        <form method="post" action="login.php">
         	<div class="input-group"> <span> <label>Username</label> <input type="text" name="username"> </span>  </div>
         	<div class="input-group"> <span> <label>Password</label> <input type="password" name="password"> </span></div>
         	<div class="input-group"> <span> <button type="submit" class="btn" name="login_user">Login</button> </span> </div>
         	<p>
         		Not yet a member? <a href="register.php">Sign up</a>
         	</p>
       	</form>

			  <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php include('errors.php'); ?></div>
			</div>
	  </div>
	</div>
</body>
</html>

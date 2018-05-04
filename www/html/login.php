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

  			<form action = "" method = "post">
        <?php include('errors.php'); ?>
  			 	<label>User</label><input type = "text" name = "username" class = "box"/><br /><br />
  			 	<label>Password</label><input type = "password" name = "password" class = "box" /><br/><br />
  			 	<input type = "submit" value = " Submit "/><br />
  			</form>

			  <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
			</div>
	  </div>
	</div>
</body>
</html>

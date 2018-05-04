<?php
  include "../inc/dbinfo.inc"; 
  session_start();
  if($_SERVER["REQUEST_METHOD"] == "POST") {
   // username and password sent from form

   $myusername = mysqli_real_escape_string($db,$_POST['username']);
   $mypassword = mysqli_real_escape_string($db,$_POST['password']);

   $sql = "SELECT id FROM admin WHERE username = '$myusername' and passcode = '$mypassword'";
   $result = mysqli_query($db,$sql);
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
   $active = $row['active'];

   $count = mysqli_num_rows($result);

   // If result matched $myusername and $mypassword, table row must be 1 row

   if($count == 1) {
      session_register("myusername");
      $_SESSION['login_user'] = $myusername;

      header("location: welcome.php");
   }else {
      $error = "Your Login Name or Password is invalid";
   }
}
?>
<html>
  <head>
    <style>
      <?php include "class.css"; ?>
    </style>
  </head>
<body>
<h1>Login Page</h1>

	<div align = "center">
    <div style = "width:300px; border: solid 3px black; " align = "left">
      <div style = "background-color:black; color:white; padding:10px;"><h2>Login</h2></div>
			<div style = "margin:30px">

  			<form action = "" method = "post">
  			 	<label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
  			 	<label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
  			 	<input type = "submit" value = " Submit "/><br />
  			</form>

			  <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
			</div>
	  </div>
	</div>
</body>
</html>

<?php include "../inc/dbinfo.inc"; ?>
<html>
  <head>
    <style>
      <?php include "class.css"; ?>
      <?php include "server.php"; ?>
    </style>
  </head>
<body>
<div class="content"><h1>Registration Page</h1></div>
<section>
  <article style="border: none;"> </article>
  <article>
    <div class="container">
 	  		<form method="post" action="register.php">
      		<label>Username</label><input type="text" name="username" value="<?php echo $username; ?>"><br />
      		<label>Email</label><input type="email" name="email" value="<?php echo $email; ?>"><br />
      		<label>Password</label><input type="password" name="password_1"><br />
      		<label>Confirm password</label><input type="password" name="password_2"><br />
      		<button type="submit" class="btn" name="reg_user">Register</button>
 	  		</form>
		    <?php include('errors.php'); ?>
      <p> Already a member? <a href="login.php">Sign in</a> </p>
    </div>
  </article>
  <article style="border: none;"> </article>
</section>
</body>
</html>

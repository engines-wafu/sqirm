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
<div class="content"><h1>Login Page</h1></div>
<section>
  <article style="border: none;"> </article>
  <article>
    <div class="container">
      <img src="img/logosm.png" width="150px" align="center" />
      <form method="post" action="login.php">
        <label>Username</label> <input type="text" name="username"> <br />
        <label>Password</label> <input type="password" name="password"> <br />
        <button type="submit" class="btn" name="login_user">Login</button> <br />
        <p> <a href="register.php">Sign up</a> </p>
      </form>
    <?php include('errors.php'); ?>
    </div>
  </article>
  <article style="border: none;"> </article>
</section>
</body>
</html>

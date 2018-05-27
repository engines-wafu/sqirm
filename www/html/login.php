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
  <div class="content">
    <div>
      <h1>sqirm</h1><br>
    </div>
  </div>
<section>
  <article style="border:none;"> </article>
  <article style="width:400px;";>
    <div class="container">
      <div align=center style="border:none; padding-bottom:20px">
        <img src="img/logosm.png" width="150px" align="center" />
      </div>
      <form action="" method="post">
        <div class="ll">
          <h4>
            Name
          </h4>
        </div>
        <div class="li">
          <input type="text" name="username"> <br />
        </div>
        <div class="ll">
          <h4>
            Password
          </h4>
        </div>
        <div class="li">
          <input type="password" name="password"> <br />
        </div>
        <button type="submit" class="btn" name="login_user">Login</button> <br />
        <p> <a href="register.php">Sign up</a> </p>
      </form>
    <?php include('errors.php'); ?>
    </div>
  </article>
  <article style="border: none;"> 
    <div class="alert">
      <div>
        <h3>
        Disclaimer 
        </h3>
        <p>
        </p>
      </div>
    </div>
  </article>
</section>
</body>
</html>

<?php
   include('session.php');
?>
<html>
  <head>
    <style>
      <?php include "class.css"; ?>
    </style>
  </head>
  <body>
   	<h1>Welcome Page</h1>
   	<h1>Welcome <?php echo $login_session; ?></h1> 
   	<h2><a href = "logout.php">Sign Out</a></h2>
  </body>
</html>

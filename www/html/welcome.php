<?php
   include('session.php');
?>
<html>
  <head>
   	<h1>Welcome Page</h1>
  </head>
  <body>
   	<h1>Welcome <?php echo $login_session; ?></h1> 
   	<h2><a href = "logout.php">Sign Out</a></h2>
  </body>
</html>

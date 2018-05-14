<?php
include "session.php";
include "../inc/dbinfo.inc";

/* Connect to MySQL and select the database. */
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

$database = mysqli_select_db($connection, DB_DATABASE);
$action = $_GET["actID"]

?>
<html>
  <head>
    <style>
      <?php include "class.css"; ?>
    </style>
  </head>
  <body>
    <div class="content">
      <div>
        <div class="a">
          <h1>Open Actions Page</h1>
          <?php  if (isset($_SESSION['username'])) : ?>
          <h3>Logged in as <?php echo $_SESSION['username']; ?> <a href="welcome.php?logout='1'">logout</a> </h3>
          <?php endif ?>
        </div>
        <div class="c" width=100px>
          <img src="img/logosm.png" width="100px"/>
        </div>
      </div>
    </div>
    <?php include "navbar.php"; ?>
    <!-- Main Splash Page Sections -->
  
    <div class="content">
      <div>
        <?php
          $query = "SELECT * FROM actions WHERE actID = '" . $action . "'";
          $result = mysqli_query($connection, $query); 
          $row = mysqli_fetch_array($result);
          $ID = $row['actID'];
          $sqaairID = $row['sqaairID'];
          $WRAG = $row['actWRAG'];
          $description = $row['actIssue'];
          $topic = $row['actTopic'];
          $origin = $row['actOrigin'];
          $owner = $row['actOwner'];
          $dl = $row['actDL'];

          echo '<h2>' $description '</h2>';

        ?>
      <div>
    </div>
  </body>
</html>

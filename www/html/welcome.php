<?php include "session.php"; ?>
<?php include "../inc/dbinfo.inc"; ?>
<?php

/* Connect to MySQL and select the database. */
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

$database = mysqli_select_db($connection, DB_DATABASE);
$hazard = $_GET["hazID"]

?>
<html>
  <head>
    <style>
      <?php include "class.css"; ?>
    </style>
  </head>
  <body>
    <div class="content">
      <!-- notification message -->
      <?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
        <h3>
          <?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
          ?>
        </h3>
        <?php endif ?>
        <!-- logged in user information -->
        <?php  if (isset($_SESSION['username'])) : ?>
        <h1>Welcome Page</h1><br>
        <p>Logged in as <?php echo $_SESSION['username']; ?> <a href="welcome.php?logout='1'">logout</a> </p>
        <?php endif ?>
      </div>
    </div>
    <!-- Main Splash Page Sections -->

    <section>
      <!-- Left division -->
      <article> 
        <div>
          <h2>List of active hazards</h2>
          <!-- Get hazards from database -->
          <?php
          		$query = "SELECT * FROM hazard";
            $result = mysqli_query($connection, $query); 
          
            while ($row = mysqli_fetch_array($result)) {
            		echo '<p class="tile_hazard"> href="RiskView.php?hazID=' . $row['hazID'] . '">' . $row['hazID'] . ' - ' . $row['hazDesc'] . '</p>' ;
            }
          ?>
        </div>
      </article>

      <!-- Centre article -->
      <article>
        <div>
          <p>Words in here</p>
        </div>
      </article>

      <!-- Right article -->
      <article>
        <!-- Right top article -->
        <div>
          <p>Words in here</p>
        </div>
        <!-- Right top article -->
        <div>
          <p>Words in here</p>
        </div>
      </article>
    </section>

  </body>
</html>

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
      <div>
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
        <div>
          <h3>Logged in as <?php echo $_SESSION['username']; ?> <a href="welcome.php?logout='1'">logout</a> </h3>
        </div>
        <?php endif ?>
      </div>
    </div>
    <!-- Main Splash Page Sections -->

    <section>
      <!-- Left division -->
      <article> 
        <div>
          <h2>List of Active Hazards</h2>
          <!-- Get hazards from database -->
          <?php
          		$query = "SELECT * FROM hazard";
            $result = mysqli_query($connection, $query); 
          
            while ($row = mysqli_fetch_array($result)) {
            		echo '<p class="tile_hazard"><b><a href="RiskView.php?hazID=' . $row['hazID'] . '">' . $row['hazID'] . ' - ' . $row['hazDesc'] . '</a></b></p>' ;
            }
          ?>
        </div>
      </article>

      <!-- Centre article -->
      <article>
        <div>
          <h2>List of Active Controls</h2>
          <!-- Get controls from database -->
          <?php
            $query = "SELECT * FROM controls ORDER BY conWRAG";
            $result = mysqli_query($connection, $query); 
          
            while ($row = mysqli_fetch_array($result)) {
            		echo '<p class="' . $row['conWRAG'] . ' tile_control"><b>' . $row['conID'] . ' - ' . $row['conDesc'] . '</b></p>' ;
            }
	         ?>	
        </div>
      </article>

      <!-- Right article -->
      <article>
        <!-- Right top article -->
        <div width="400" !important>
          <h2>Key Performance Indicators</h2>
          
          <?php
          $query = "SELECT kpiID, kpiDesc FROM kpis";
          $result = mysqli_query($connection, $query); 
          while ($row = mysqli_fetch_array($result)) {
            echo '   <canvas id="#kpicanvas' . $row['kpiID'] . '" class="kpi"></canvas>';
          }
          ?>

          <!-- javascript -->
          <script type="text/javascript" src="js/jquery.js"></script>
          <script type="text/javascript" src="js/Chart.js"></script>
          <script type="text/javascript" src="js/app.js"></script>
        </div>
        <!-- Right top article -->
        <div>
		  <h2>My Actions and Issues</h2>
        </div>
      </article>
    </section>

  </body>
</html>

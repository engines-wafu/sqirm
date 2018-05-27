<?php include "session.php";
include "../inc/dbinfo.inc"; 

/* Connect to MySQL and select the database. */
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS);

if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

$database = mysqli_select_db($connection, DBNAME);
$hazard = $_GET["hazID"];
$user = $_SESSION['username'];

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
        <!-- logged in user information -->
        <?php  if (isset($_SESSION['username'])) : ?>
        <div style="width: 60%; float:left; border-style:none; padding:0">
          <h1>Welcome Page</h1><br>
          <h3>Logged in as <?php echo $_SESSION['username']; ?> <a href="welcome.php?logout='1'">logout</a> </h3>
        </div>
        <div style="float:right; align:right; border-style:none; padding-right:20">
          <img src="img/logosm.png" width="100px"/>
        </div>
        <?php endif ?>
      </div>
    </div>

    <?php include "navbar.php"; ?>

    <!-- Main Splash Page Sections -->

    <section>
      <!-- Left division -->
      <article> 
        <div style="overflow:scroll; height:500px">
          <h2>List of Active Hazards</h2>
          <!-- get hazards from database -->
          <?php
          $query = "select * from hazard";
          $result = mysqli_query($connection, $query); 
          
          while ($row = mysqli_fetch_array($result)) {
            echo '<p class="tile_hazard"><b><a href="RiskView.php?hazID=' . $row['hazID'] . '">' . $row['hazID'] . ' - ' . $row['hazDesc'] . '</a></b></p>' ;
          }
          ?>
        </div>
      </article>

      <!-- Centre article -->
      <article>
        <div style="overflow:scroll; height:500px">
          <h2>List of Active Controls</h2>
          <!-- Get controls from database -->
          <?php
          $query = "SELECT * FROM controls ORDER BY conWRAG";
          $result = mysqli_query($connection, $query); 
          
          while ($row = mysqli_fetch_array($result)) {
            echo '<p class="' . $row['conWRAG'] . ' tile_control"><b><a href="controls.php?conID=' . $row['conID'] . '">' . $row['conID'] . ' - ' . $row['conDesc'] . '</a></b></p>' ;
          }
          ?>	
        </div>
      </article>

      <!-- Right article -->
      <article>
        <!-- Right top article -->
        <div style="align-items: flex-start; overflow:scroll; height:136px !important">
          <h2>Key Performance Indicators</h2>

          <?php
          $query = "SELECT kpiID, kpiDesc FROM kpis";
          $result = mysqli_query($connection, $query); 
          while ($row = mysqli_fetch_array($result)) {
            echo '<div id="kpiblock">';
              echo '<canvas id="#kpicanvas' . $row['kpiID'] . '" class="kpi"></canvas>';
              echo '<h3 align=center style="width: 80px !important;">' . $row['kpiDesc'] . '</h3>';
            echo '</div>';
          }
          ?>

          <!-- javascript -->
          <script type="text/javascript" src="js/jquery.js"></script>
          <script type="text/javascript" src="js/Chart.js"></script>
          <script type="text/javascript" src="js/app.js"></script>
        </div>
        <!-- Right top article -->
        <div style="overflow:scroll; height:348px; margin-top:4px">
          <h2>My Actions and Issues</h2>
          <table>
          <?php
            $query = "SELECT actWRAG, actID, actIssue FROM actions WHERE actOwner = '" . $user . "'";
            $result = mysqli_query($connection, $query); 
            while ($row = mysqli_fetch_array($result)) {
              $ID = $row['actID'];
              $WRAG = $row['actWRAG'];
              $description = $row['actIssue'];
              $owner = $row['actOwner'];
              echo '<p class="tile_action ' . $WRAG . '"><b><a href="action.php?actID=' . $ID . '">' . $ID . ' - ' . $description . '</a></b></p>' ;
            }
          ?>
          </table>
        </div>
      </article>
    </section>
  </body>
</html>

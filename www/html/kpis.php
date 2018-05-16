<?php
include "session.php";
include "../inc/dbinfo.inc";
/* Connect to MySQL and select the database. */
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
$database = mysqli_select_db($connection, DB_DATABASE);
$hazard = $_GET["conID"]
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
          <h1>Key Performance Inditcators Page</h1>
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
      <div class="content">
        <div class="kpi_container">
          <div class="kpi_line">
            <div style="flex-grow: 3">Gas Gauge</div>
            <div style="flex-grow: 4">Title</div>
            <div style="flex-grow: 4">Green Threshold</div>
            <div style="flex-grow: 4">Amber Threshold</div>
            <div style="flex-grow: 4">Red Threshold</div>
            <div style="flex-grow: 1">Sumbit</div>
          </div>
          <div class="kpi_line">
          </div>
          <div class="kpi_line">
          </div>
          <div class="kpi_line">
          </div>
          <div class="kpi_line">
          </div>
          <?php
          echo '<div class="kpi_line">';
          $query = "SELECT * FROM kpis";
          $result = mysqli_query($connection, $query); 
          while ($row = mysqli_fetch_array($result)) {
            $name = $_SESSION['username'];
            $date = date('Y-m-d');
            $description = $_POST['kpiDesc'];
            $kpiID = $_POST['kpiID'];
            $val1 = $_POST['kpiVal1'];
            $desc1 = $_POST['kpiDesc1'];
            $val2 = $_POST['kpiVal2'];
            $desc2 = $_POST['kpiDesc2'];
            $val3 = $_POST['kpiVal3'];
            $desc3 = $_POST['kpiDesc3'];
                echo '<canvas id="#kpicanvas' . $row['kpiID'] . '" class="kpi"></canvas>';
                echo '<input type="text" id="' . $row['kpiDesc'] . '" value="' . $row['kpiDesc']. '">';
                echo '<input type="text" id="' . $row['kpiDesc1'] . '" value="' . $row['kpiDesc1']. '">';
                echo '<input type="text" id="' . $row['kpiVal1'] . '" value="' . $row['kpiVal1']. '">';
                echo '<input type="text" id="' . $row['kpiDesc2'] . '" value="' . $row['kpiDesc2']. '">';
                echo '<input type="text" id="' . $row['kpiVal2'] . '" value="' . $row['kpiVal2']. '">';
                echo '<input type="text" id="' . $row['kpiDesc3'] . '" value="' . $row['kpiDesc3']. '">';
                echo '<input type="text" id="' . $row['kpiVal3'] . '" value="' . $row['kpiVal3']. '">';
          echo '</div>';
          }
          ?>
        </div>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/Chart.js"></script>
    <script type="text/javascript" src="js/app.js"></script>
  </body>
</html>

<?php
include "session.php";
include "../inc/dbinfo.inc";
/* Connect to MySQL and select the database. */
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS);
if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
$database = mysqli_select_db($connection, DBNAME);
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
    <div class="kpi_content">
      <div class="kpi_container">
        <div class="kpi_line">
          <div style="flex-grow: 2"><h4>Gas Gauge</h2></div>
          <div style="flex-grow: 3"><h4>Title</h2></div>
          <div style="flex-grow: 3"><h4>Green Threshold</h2></div>
          <div style="flex-grow: 3"><h4>Amber Threshold</h2></div>
          <div style="flex-grow: 3"><h4>Red Threshold</h2></div>
          <div style="flex-grow: 1"><h4>Sumbit</h2></div>
        </div>
        <?php
        $query = "SELECT * FROM kpis SORT BY kpiVal3/(kpiVal1+kpiVal2+kpiVal3)";
        $result = mysqli_query($connection, $query); 
        while ($row = mysqli_fetch_array($result)) {
        echo '
        <form method="POST" action="submitkpis.php?kpiID=' . $row['kpiID'] . '">
          <div class="kpi_line">
            <div style="flex-grow: 2"><canvas id="#kpicanvas' . $row['kpiID'] . '" class="kpi"></canvas></div>
            <div style="flex-grow: 3">
              <input type="text" name="description" value="' . $row['kpiDesc'] . '"/>
            </div>
            <div style="flex-grow: 3">
              <input type="text" name="kpiDesc1" value="' . $row['kpiDesc1'] . '"/>
              <input type="text" name="kpiVal1" value="' . $row['kpiVal1'] . '"/>
            </div>
            <div style="flex-grow: 3">
              <input type="text" name="kpiDesc2" value="' . $row['kpiDesc2'] . '"/>
              <input type="text" name="kpiVal2" value="' . $row['kpiVal2'] . '"/>
            </div>
            <div style="flex-grow: 3">
              <input type="text" name="kpiDesc3" value="' . $row['kpiDesc3'] . '"/>
              <input type="text" name="kpiVal3" value="' . $row['kpiVal3'] . '"/>
            </div>
            <div style="flex-grow: 1">
              <input type="submit" name="Sumbit"/>
            </form>
            <form method="POST" action="deletekpi.php?kpiID=' . $row['kpiID'] . '">
              <input type="submit" value="DELETE!"/>
            </form>
            </div>
          </div>
        ';
        }
        ?>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/Chart.js"></script>
        <script type="text/javascript" src="js/app.js"></script>
        <form method="POST" action="createnewkpi.php">
        <div class="kpi_line">
          <div style="flex-grow: 2"><h4>Create New KPI</h4></div>
          <div style="flex-grow: 3">
            <input type="text" name="description"/>
          </div>
          <div style="flex-grow: 3">
            <input type="text" name="kpiDesc1"/>
            <input type="text" name="kpiVal1"/>
          </div>
          <div style="flex-grow: 3">
            <input type="text" name="kpiDesc2"/>
            <input type="text" name="kpiVal2"/>
          </div>
          <div style="flex-grow: 3">
            <input type="text" name="kpiDesc3"/>
            <input type="text" name="kpiVal3"/>
          </div>
          <div style="flex-grow: 1">
            <input type="submit" name="Sumbit"/>
          </div>
        </div>
        </form>
      </div>
    </div>
  </body>
</html>

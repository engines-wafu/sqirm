<?php include "session.php"; ?>
<?php include "../inc/dbinfo.inc"; ?>
<?php

/* Connect to MySQL and select the database. */
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

$database = mysqli_select_db($connection, DB_DATABASE);

?>
<html>
  <head>
    <title>ChartJS - BarGraph</title>
    <style type="text/css">
      canvas {
        display:inline !important;
      }
    </style>
  </head>
  <body>
<?php
$query = "SELECT kpiID FROM kpis";
$result = mysqli_query($connection, $query); 
while ($row = mysqli_fetch_array($result)) {
  echo '<div width=150 height=150>';
  echo '   <canvas id="#kpicanvas' . $row['kpiID'] . '" width="75" !important height="150" !important></canvas>';
  echo '</div>';
}
?>

    <!-- javascript -->
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/Chart.js"></script>
    <script type="text/javascript" src="js/app.js"></script>
  </body>
<html/html>

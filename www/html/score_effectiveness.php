<?php

include "session.php";
include "../inc/dbinfo.inc";

$connection = mysqli_connect(DBHOST, DBUSER, DBPASS);
if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
$database = mysqli_select_db($connection, DBNAME);
$control = $_GET["conID"]

?>

<html>
  <head>
    <style>
      <?php include "class.css"; ?>
    </style>
  </head>
  <body>

<?php

$query = "SELECT kpiVal1, kpiVal2, kpiVal3, kpiVal3/(kpiVal1+kpiVal2+kpiVal3) AS kpiWeight FROM kpis";
$result = mysqli_query($connection, $query); 
while ($row = mysqli_fetch_array($result)) {
  echo '<p> This is the weighted kpi value: ' .  $row['kpiWeight'] . '</p>';
}

?>

  </body>
</html>


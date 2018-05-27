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

$query = "SELECT kpiDesc, kpiVal1, kpiVal2, kpiVal3, kpiVal3/(kpiVal1+kpiVal2+kpiVal3) AS kpiWeight FROM kpis INNER JOIN controls ON kpis.kpiID = controls.kpiPriID";
$result = mysqli_query($connection, $query); 
while ($row = mysqli_fetch_array($result)) {
  $k = $row['kpiWeight'];
  echo '<p> The weighted kpi value of ' . $row['kpiDesc'] . ' is: ' .  $k . '</p>';
}

$query = "SELECT conWRAG, conID FROM controls WHERE conID = " . $control;
$result = mysqli_query($connection, $query); 
while ($row = mysqli_fetch_array($result)) {
  if ($row['conWRAG'] == 'white') {
    $s = '0';
  } elseif ($row['conWRAG'] == 'green') {
    $s = '1';
  }
  } elseif ($row['conWRAG'] == 'yellow') {
    $s = '0.5';
  }
  } elseif ($row['conWRAG'] == 'red') {
    $s = '0.1';
  }
  echo '<p>Subjective score is: ' . $s . '</p>';
}

$e = $s * $k ;

echo '<p>Total effectiveness score is: ' . $e . '</p>';

?>

  </body>
</html>


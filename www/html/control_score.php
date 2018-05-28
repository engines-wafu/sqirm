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

$query = "SELECT kpiPriID FROM controls WHERE conID = " . $control;
$result = mysqli_query($connection, $query); 
if ($row = mysqli_fetch_array($result)) {
  $kpiPriID = $row['kpiPriID'];
  echo '<p> The associated primary kpi is: ' . $kpiPriID;
} else {
  echo 'No associated kpi';
}

$query = "SELECT kpiDesc, kpiVal1, kpiVal2, kpiVal3, (kpiVal1 + kpiVal2)/(kpiVal1 + kpiVal2 + kpiVal3) AS kpiWeight FROM kpis WHERE kpiID = " . $kpiPriID;
$result = mysqli_query($connection, $query); 
if ($row = mysqli_fetch_array($result)) {
  $k = $row['kpiWeight'];
  echo '<p> The weighted kpi value ' . $row['kpiDesc'] . ' is: ' .  $k . '</p>';
} else {
  $k = '1';
  echo '<p> The weighted kpi value ' . $row['kpiDesc'] . ' is: ' .  $k . ' because there are no kpis associated</p>';
}

$query = "SELECT conwrag, conid FROM controls WHERE conid = " . $control;
$result = mysqli_query($connection, $query); 
while ($row = mysqli_fetch_array($result)) {
  if ($row['conwrag'] == 'white') {
    $s = '0';
  } elseif ($row['conwrag'] == 'green') {
    $s = '1';
  } elseif ($row['conwrag'] == 'yellow') {
    $s = '0.5';
  } elseif ($row['conwrag'] == 'red') {
    $s = '0.1';
  }
  echo '<p>Subjective score is: ' . $s . '</p>';
}

$query = "SELECT conPriID FROM actions WHERE conPriID =" . $control;
$result = mysqli_query($connection, $query); 
if ($row = mysqli_fetch_array($result)) {
  $n_i = mysqli_num_rows($result);
  echo '<p>Number of associated actions is: ' . $n_i . '</p>';
}

$query = "SELECT actID FROM actions";
$result = mysqli_query($connection, $query); 
if ($row = mysqli_fetch_array($result)) {
  $n_t = mysqli_num_rows($result);
  echo '<p>Total number of actions is: ' . $n_t . '</p>';
}

$e = $s * $k * (($n_t - $n_i) / $n_t) ;

echo '<p>Total effectiveness score is: ' . $e . '</p>';

$query = "SELECT conID FROM consequence_control";
$result = mysqli_query($connection, $query); 
if ($row = mysqli_fetch_array($result)) {
  $n_cc = mysqli_num_rows($result);
  echo '<p>Total number of associated consequences is: ' . $n_cc . '</p>';
}

$query = "SELECT conID FROM threat_control";
$result = mysqli_query($connection, $query); 
if ($row = mysqli_fetch_array($result)) {
  $n_tc = mysqli_num_rows($result);
  echo '<p>Total number of associated threats is: ' . $n_tc . '</p>';
}

?>

  </body>
</html>


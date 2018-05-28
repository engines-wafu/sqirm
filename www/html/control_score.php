<?php
include "session.php";
include "../inc/dbinfo.inc";
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS);
if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
$database = mysqli_select_db($connection, DBNAME);
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
}

$query = "SELECT kpiDesc, kpiVal1, kpiVal2, kpiVal3, (kpiVal1 + kpiVal2)/(kpiVal1 + kpiVal2 + kpiVal3) AS kpiWeight FROM kpis WHERE kpiID = " . $kpiPriID;
$result = mysqli_query($connection, $query); 
if ($row = mysqli_fetch_array($result)) {
  $k = $row['kpiWeight'];
} else {
  $k = '1';
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
}

$query = "SELECT conPriID FROM actions WHERE conPriID =" . $control;
$result = mysqli_query($connection, $query); 
if ($row = mysqli_fetch_array($result)) {
  $n_i = mysqli_num_rows($result);
}

$query = "SELECT actID FROM actions";
$result = mysqli_query($connection, $query); 
if ($row = mysqli_fetch_array($result)) {
  $n_t = mysqli_num_rows($result);
}

$e = $s * $k * (($n_t - $n_i) / $n_t) ;

$query = "SELECT conID FROM consequence_control WHERE conID = " . $control;
$result = mysqli_query($connection, $query); 
if ($row = mysqli_fetch_array($result)) {
  $n_cc = mysqli_num_rows($result);
}

$query = "SELECT conID FROM threat_control WHERE conID = " . $control;
$result = mysqli_query($connection, $query); 
if ($row = mysqli_fetch_array($result)) {
  $n_tc = mysqli_num_rows($result);
}

$query = "SELECT conID FROM threat_control";
$result = mysqli_query($connection, $query); 
if ($row = mysqli_fetch_array($result)) {
  $n_ta = mysqli_num_rows($result);
}

$c = ($n_cc + $n_tc) / $n_ta;

$t = hypot( $c, (1 - $e) );

$query = 'UPDATE controls SET conScore = "' . $t . '" WHERE conID = "' . $control . '"';
if ($result = mysqli_query($connection, $query)) {; 
}

?>
<?php

  header('Location: controls.php?conID=' . $control);
?>

  </body>
</html>

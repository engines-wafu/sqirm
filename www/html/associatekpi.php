<?php 
include "session.php"; 
include "../inc/dbinfo.inc";

/* Connect to MySQL and select the database. */
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS);

if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

$database = mysqli_select_db($connection, DBNAME);
$control = $_GET["conID"];

$kpiPriID = $_POST["$kpiID"];

$query = 'UPDATE controls SET kpiPriID = "' . $kpiPriID . '" WHERE conID = "' . $control . '"';

if (mysqli_query($connection, $query)) {
  header('Location: controls.php?conID=' . $control);
  exit;
} else {
  echo "Error: " . $query . "<br>" . mysqli_error($connection);
}
?>

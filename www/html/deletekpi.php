<?php 
include "session.php"; 
include "../inc/dbinfo.inc";

/* Connect to MySQL and select the database. */
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS);

if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

$database = mysqli_select_db($connection, DBNAME);
$kpiID = $_GET["kpiID"];

$sql = 'DELETE FROM kpis WHERE kpiID="' . $kpiID . '"';

if (mysqli_query($connection, $sql)) {
  header ('Location: kpis.php');
  exit;
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($connection);
}

?>

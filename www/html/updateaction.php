<?php 
include "session.php"; 
include "../inc/dbinfo.inc";

/* Connect to MySQL and select the database. */
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS);

if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

$database = mysqli_select_db($connection, DBNAME);
$action = $_GET["actID"];
$description = $_POST["description"];

$sql = 'UPDATE actions SET actDesc = "' . $description . '", kpiDesc1 = "' . $kpiDesc1 . '" WHERE kpiID = "' . $kpiID . '"';

if (mysqli_query($connection, $sql)) {
  $description = $_POST["description"];
  header('Location: action.php?actID='" . $action . "'');
  exit;
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($connection);
}

?>

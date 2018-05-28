<?php 
include "session.php"; 
include "../inc/dbinfo.inc";

/* Connect to MySQL and select the database. */
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS);

if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

$database = mysqli_select_db($connection, DBNAME);
$action = $_GET["actID"];

$conID = $_POST["control"];

$query = 'UPDATE actions SET conPriID = "' . $conPriID . '" WHERE actID = "' . $action . '"';

if (mysqli_query($connection, $query)) {
  echo $conID;
  header('Location: actions.php?actID=' . $action);
  exit;
} else {
  echo "Error: " . $query . "<br>" . mysqli_error($connection);
}
?>

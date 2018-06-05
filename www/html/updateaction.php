<?php 
include "session.php"; 
include "../inc/dbinfo.inc";

/* Connect to MySQL and select the database. */
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS);

if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

$database = mysqli_select_db($connection, DBNAME);
$action = $_GET["actID"];
$description = $_POST["description"];
$owner = $_POST["owner"];

$sql = 'UPDATE actions SET actIssue = "' . $description . '", actOwner = "' . $owner . '" WHERE actID = "' . $action . '"';

if (mysqli_query($connection, $sql)) {
  exit;
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($connection);
}

?>

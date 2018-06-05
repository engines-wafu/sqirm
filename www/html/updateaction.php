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
$red = $_POST["red"];
$yellow = $_POST["yellow"];
$green = $_POST["green"];
$wrag = $_POST["WRAGradio"];

$sql = 'UPDATE actions SET actIssue = "' . $description . '", actOwner = "' . $owner . '", actWRAG = "' . $wrag . '" WHERE actID = "' . $action . '"';

if (mysqli_query($connection, $sql)) {
  echo $red;
  echo $yellow;
  echo $green;
  echo $description;
  echo $owner;
  echo $wrag;
  #header('Location: action.php?actID=' . $action );
  exit;
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($connection);
}

?>

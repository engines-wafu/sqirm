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
$red = $_POST["owner"];
$owner = $_POST["owner"];
if ($_POST["red"] == "checked") {
  $wrag = "red";
} else if ($_POST["yellow"] == "checked") {
  $wrag = "yellow";
} else if ($_POST["green"] == "checked") {
  $wrag = "green";
} else if ($_POST["white"] == "checked") {
  $wrag = "white";
};

$sql = 'UPDATE actions SET actIssue = "' . $description . '", actOwner = "' . $owner . '", actWRAG = "' . $wrag . '" WHERE actID = "' . $action . '"';

if (mysqli_query($connection, $sql)) {
  echo var_dump();
  #header('Location: action.php?actID=' . $action );
  exit;
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($connection);
}

?>

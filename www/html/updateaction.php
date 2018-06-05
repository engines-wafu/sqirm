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
$topic = $_POST["topic"];
$origin = $_POST["origin"];
$dl = $_POST["dl"];
if ($_POST["WRAGradio"] == "red"){
  $wrag = "red";
} elseif ($_POST["WRAGradio"] == "amber") {
  $wrag = "yellow";
} elseif ($_POST["WRAGradio"] == "green") {
  $wrag = "green";
} elseif ($_POST["WRAGradio"] == "white") {
  $wrag = "white";
}

$sql = 'UPDATE actions SET actIssue = "' . $description . '", actOwner = "' . $owner . '", actWRAG = "' . $wrag . '", actOrigin = '" . $origin . "', actTopic = '" . $topic . "', actDL = '" . $dl . "' WHERE actID = "' . $action . '"';

if (mysqli_query($connection, $sql)) {
  header('Location: action.php?actID=' . $action );
  exit;
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($connection);
}

?>

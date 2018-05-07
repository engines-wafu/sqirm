<?php 
include "session.php"; 
include "../inc/dbinfo.inc";

/* Connect to MySQL and select the database. */
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

$database = mysqli_select_db($connection, DB_DATABASE);
$control = $_GET["conID"];

$desc = $_POST['description'];

$sql = "UPDATE controls SET conDesc = " . "'moar stuff'," . "conActive = 'Y' WHERE conID = " . $control;

if (mysqli_query($connection, $sql)) {
  echo "Control Updated";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($connection);
}
?>

<?php 
include "session.php"; 
include "../inc/dbinfo.inc";

/* Connect to MySQL and select the database. */
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS);

if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

$database = mysqli_select_db($connection, DBNAME);

$action = $_POST["Description"];

$sql = 'INSERT INTO actions (actIssue) VALUES ("' . $description . '")';

mysqli_query($connection, $sql);

if (mysqli_query($connection, $sql)) {
  header('Location: actions.php');
  exit;
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($connection);
}

?>

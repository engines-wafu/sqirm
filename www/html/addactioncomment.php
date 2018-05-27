<?php 
include "session.php"; 
include "../inc/dbinfo.inc";

/* Connect to MySQL and select the database. */
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS);

if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

$database = mysqli_select_db($connection, DBNAME);

$action = $_GET["actID"];
$name = $_SESSION['username'];
$date = date('Y-m-d');
$comment = $_POST['comment'];

$sql = 'INSERT INTO comments (comment, username, date, active) VALUES ("' . $comment . '", "' . $name . '", "' . $date . '", 1)';

mysqli_query($connection, $sql);

$comID = mysqli_insert_id($connection);

$sql = 'INSERT INTO comment_links (comID, actID) VALUES ("' . $comID . '", "' . $action . '")';

if (mysqli_query($connection, $sql)) {
  header('Location: action.php?actID=' . $action);
  exit;
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($connection);
}

?>
